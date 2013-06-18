package com.tschrock.roku.uploader;

/**
 *
 * @author tyler
 */

import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;

import javax.imageio.ImageIO;

import com.xuggle.mediatool.IMediaReader;
import com.xuggle.mediatool.MediaListenerAdapter;
import com.xuggle.mediatool.ToolFactory;
import com.xuggle.mediatool.event.IVideoPictureEvent;
import com.xuggle.xuggler.Global;

public class VideoThumbnailer {
    
    public double thumbnailRetrieveTime = 20;
    public String inputFile = "";
    public ThumbnailListener thumbListen;
    
    public long MICRO_SECONDS_BETWEEN_FRAMES;
    
    public VideoThumbnailer(String inputFile) {
        this.inputFile = inputFile;
        MICRO_SECONDS_BETWEEN_FRAMES =  (long)(Global.DEFAULT_PTS_PER_SECOND * thumbnailRetrieveTime);
    }
    
    public VideoThumbnailer(String inputFile, double thumbTime) {
        this.inputFile = inputFile;
        this.thumbnailRetrieveTime = thumbTime;
        MICRO_SECONDS_BETWEEN_FRAMES =  (long)(Global.DEFAULT_PTS_PER_SECOND * thumbnailRetrieveTime);
    }
            
    public void getThumbnail(){
        
    }

    public static class DecodeUpdateEvent {

        public DecodeEvents status;
        public BufferedImage thumbnail = null;
        
        public DecodeUpdateEvent(DecodeEvents status) {
            this.status = status;
        }
        
        public DecodeUpdateEvent(DecodeEvents status, BufferedImage thumbnail) {
            this.status = status;
            this.thumbnail = thumbnail;
        }
    }
    
    public enum DecodeEvents{
            BEGIN,
            FILE_LOADED,
            DECODE_BEGIN,
            THUMBNAIL_CREATED,
            DECODE_END
    }
        
    public interface DecodeUpdater {
        public void onUpdate(DecodeUpdateEvent evt);
    }
    
    
    public final double THUMBNAIL_SECONDS = 20;

    private final String inputFilename = "c:/Java_is_Everywhere.mp4";
    private final String outputFilePrefix = "c:/snapshots/mysnapshot";
    
    // The video stream index, used to ensure we display frames from one and
    // only one video stream from the media container.
    private int mVideoStreamIndex = -1;
    
    // Time of last frame write
    private long mLastPtsWrite = Global.NO_PTS;

    public void main(String[] args) {

        IMediaReader mediaReader = ToolFactory.makeReader(inputFilename);

        // stipulate that we want BufferedImages created in BGR 24bit color space
        mediaReader.setBufferedImageTypeToGenerate(BufferedImage.TYPE_3BYTE_BGR);
        
        mediaReader.addListener(new ThumbnailListener());

        // read out the contents of the media file and
        // dispatch events to the attached listener
        while (mediaReader.readPacket() == null) ;

    }

    public class ThumbnailListener extends MediaListenerAdapter {

        @Override
        public void onVideoPicture(IVideoPictureEvent event) {

            if (event.getStreamIndex() != mVideoStreamIndex) {
                // if the selected video stream id is not yet set, go ahead an
                // select this lucky video stream
                if (mVideoStreamIndex == -1)
                    mVideoStreamIndex = event.getStreamIndex();
                // no need to show frames from this video stream
                else
                    return;
            }

            // if uninitialized, back date mLastPtsWrite to get the very first frame
            if (mLastPtsWrite == Global.NO_PTS)
                mLastPtsWrite = event.getTimeStamp() - MICRO_SECONDS_BETWEEN_FRAMES;

            // if it's time to write the next frame
            if (event.getTimeStamp() - mLastPtsWrite >= 
                    MICRO_SECONDS_BETWEEN_FRAMES) {
                                
                String outputFilename = dumpImageToFile(event.getImage());

                // indicate file written
                double seconds = ((double) event.getTimeStamp()) / 
                    Global.DEFAULT_PTS_PER_SECOND;
                System.out.printf(
                        "at elapsed time of %6.3f seconds wrote: %s\n",
                        seconds, outputFilename);

                // update last write time
                mLastPtsWrite += MICRO_SECONDS_BETWEEN_FRAMES;
            }

        }
        
        private String dumpImageToFile(BufferedImage image) {
            try {
                String outputFilename = outputFilePrefix + 
                     System.currentTimeMillis() + ".png";
                ImageIO.write(image, "png", new File(outputFilename));
                return outputFilename;
            } 
            catch (IOException e) {
                e.printStackTrace();
                return null;
            }
        }

    }

}