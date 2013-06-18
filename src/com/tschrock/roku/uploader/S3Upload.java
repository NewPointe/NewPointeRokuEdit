/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.tschrock.roku.uploader;

import com.amazonaws.AmazonClientException;
import com.amazonaws.auth.BasicAWSCredentials;
import com.amazonaws.services.s3.model.ProgressEvent;
import com.amazonaws.services.s3.model.ProgressListener;
import com.amazonaws.services.s3.transfer.TransferManager;
import com.amazonaws.services.s3.transfer.Upload;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStreamWriter;
import java.io.Writer;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.GregorianCalendar;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JOptionPane;
import javax.swing.JProgressBar;

/**
 *
 * @author tyler
 */
public class S3Upload extends javax.swing.JDialog {

    /**
     * Creates new form S3Upload
     */
    public S3Upload(java.awt.Frame parent, boolean modal) {
        super(parent, modal);
        initComponents();
    }

    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jScrollPane1 = new javax.swing.JScrollPane();
        jList1 = new javax.swing.JList();
        jScrollBar1 = new javax.swing.JScrollBar();
        jPanel2 = new javax.swing.JPanel();
        jPanel1 = new javax.swing.JPanel();
        jProgressBar1 = new javax.swing.JProgressBar();
        jLabel1 = new javax.swing.JLabel();
        jLabel2 = new javax.swing.JLabel();

        jList1.setModel(new javax.swing.AbstractListModel() {
            String[] strings = { "Item 1", "Item 2", "Item 3", "Item 4", "Item 5" };
            public int getSize() { return strings.length; }
            public Object getElementAt(int i) { return strings[i]; }
        });
        jScrollPane1.setViewportView(jList1);

        javax.swing.GroupLayout jPanel2Layout = new javax.swing.GroupLayout(jPanel2);
        jPanel2.setLayout(jPanel2Layout);
        jPanel2Layout.setHorizontalGroup(
            jPanel2Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGap(0, 0, Short.MAX_VALUE)
        );
        jPanel2Layout.setVerticalGroup(
            jPanel2Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGap(0, 148, Short.MAX_VALUE)
        );

        setDefaultCloseOperation(javax.swing.WindowConstants.DO_NOTHING_ON_CLOSE);
        setAlwaysOnTop(true);
        setModal(true);
        setResizable(false);
        setType(java.awt.Window.Type.UTILITY);

        jPanel1.setBackground(new java.awt.Color(102, 170, 61));
        jPanel1.setBorder(javax.swing.BorderFactory.createLineBorder(new java.awt.Color(0, 0, 0)));

        jProgressBar1.setStringPainted(true);

        jLabel1.setText("jLabel1");

        jLabel2.setText("jLabel1");

        javax.swing.GroupLayout jPanel1Layout = new javax.swing.GroupLayout(jPanel1);
        jPanel1.setLayout(jPanel1Layout);
        jPanel1Layout.setHorizontalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(jProgressBar1, javax.swing.GroupLayout.DEFAULT_SIZE, 574, Short.MAX_VALUE)
                    .addGroup(jPanel1Layout.createSequentialGroup()
                        .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(jLabel2)
                            .addComponent(jLabel1))
                        .addGap(0, 0, Short.MAX_VALUE)))
                .addContainerGap())
        );
        jPanel1Layout.setVerticalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, jPanel1Layout.createSequentialGroup()
                .addContainerGap()
                .addComponent(jLabel2)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                .addComponent(jProgressBar1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jLabel1)
                .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
        );

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(jPanel1, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(jPanel1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException | InstantiationException | IllegalAccessException | javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(S3Upload.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the dialog */
        java.awt.EventQueue.invokeLater(new Runnable() {
            @Override
            public void run() {
                S3Upload dialog = new S3Upload(new javax.swing.JFrame(), true);
                dialog.addWindowListener(new java.awt.event.WindowAdapter() {
                    @Override
                    public void windowClosing(java.awt.event.WindowEvent e) {
                        //System.exit(0);
                    }
                });
                dialog.setVisible(true);
            }
        });
    }
    private static String user = "RokuUpdater";
    private static String pass = "KsKxMzphhu5DALBV";
    private SQLConnector scon = new SQLConnector("roku", "192.168.1.14", user, pass);
    private String accessKey = "AKIAI33V2XGY3AHXLB4Q";
    private String secretKey = "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";
    private TransferManager transMan = new TransferManager(new BasicAWSCredentials(accessKey, secretKey));
    List<File> tmpXmlFiles = new ArrayList();
    List<String> tmpXmlFileNames = new ArrayList();

    public void runActions(actionevents[] actions, String[][] actionArg) {
        // Should run this in another thread so we dont block the caller
        (new Thread(new RunActions(actions, actionArg))).start();
    }

    public class RunActions implements Runnable {

        actionevents[] actns;
        String[][] actnArgs;

        public RunActions(actionevents[] actions, String[][] actionArg) {
            actns = actions;
            actnArgs = actionArg;
        }

        @Override
        public void run() {
            onEvent(UploadEvents.BEGIN, "Starting processing " + actns.length + " tasks.");
            for (int actn = 0; actn < actns.length; actn++) {
                try {
                    switch (actns[actn]) {
                        case RUN_SQL:
                            setLongProgressState("Running task " + (actn + 1) + " of " + actns.length + "");
                            setShortProgressState("Updating database...");
                            if (scon.connect_throwerrors()) {
                                scon.runUpdateQuery(actnArgs[actn][0]);
                                setShortProgressState("Done", 1, 1);
                            } else {
                                throw new SQLException("Could not connect to SQL database.");
                            }
                            onEvent(UploadEvents.SQL_RUN, "Ran some SQL.");
                            break;
                        case GENERATE_XML:
                            setLongProgressState("Running task " + (actn + 1) + " of " + actns.length + "");
                            setShortProgressState("Generating data files...");

                            generateXML();

                            setShortProgressState("Done", 1, 1);
                            onEvent(UploadEvents.XML_GENERATED, "Generated some XML.");
                            break;
                        case UPLOAD_FILE:
                            setLongProgressState("Running task " + (actn + 1) + " of " + actns.length + "");
                            setShortProgressState("Uploading files to the server...");
                            
                            
                            File fl = new File(actnArgs[actn][1]);
                            int filelength = (int) fl.length();
                            setShortProgressState("Uploading File: " + fl.getName(), 0, filelength);
                            Upload upld = transMan.upload(actnArgs[actn][0], actnArgs[actn][2], fl);
                            upld.addProgressListener(new Flchng(jProgressBar1, filelength));
                            upld.waitForCompletion();
                            
                            
                            setShortProgressState("Done", 1, 1);
                            onEvent(UploadEvents.FILE_UPLOADED, "Uploaded a file.");
                            break;
                        case UPLOAD_XML:
                            setLongProgressState("Running task " + (actn + 1) + " of " + actns.length + "");
                            setShortProgressState("Uploading data files to the server...");
                            
                            int flLength = 0;
                            
                            for(int fls = 0; fls < tmpXmlFiles.size(); fls++){
                                flLength += (int) tmpXmlFiles.get(fls).length();
                            }
                            
                            List<Upload> ulds = new ArrayList<>();
                            
                            for(int fls = 0; fls < tmpXmlFiles.size(); fls++){
                                Upload xmlupld = transMan.upload("NewPointeRoku/xml", tmpXmlFileNames.get(fls), tmpXmlFiles.get(fls));
                                xmlupld.addProgressListener(new Flchng(jProgressBar1, flLength));
                                ulds.add(xmlupld);
                            }
                            
                            for(int fls = 0; fls < ulds.size(); fls++){
                                ulds.get(fls).waitForCompletion();
                            }
                            
                            setShortProgressState("Done", 1, 1);
                            onEvent(UploadEvents.XML_UPLOADED, "Uploaded some XML.");
                            break;
                        default:

                            // This should not run unless someone messed with the types
                            throw new IndexOutOfBoundsException("Unknown action: " + actns[actn].name());
                    }
                } catch (SQLException | ClassNotFoundException | InstantiationException | IllegalAccessException | AmazonClientException | InterruptedException | IOException | IndexOutOfBoundsException ex) {
                    Logger.getLogger(S3Upload.class.getName()).log(Level.SEVERE, null, ex);
                    setLongProgressState("Oh noes! An error occured on step " + (actn + 1) + ".");
                    onEvent(UploadEvents.ERROR, "Error in task  " + (actn + 1) + ".");
                    iGotzAnErrar(actn + 1, ex);
                    return;
                    //break;
                }
            }

            setLongProgressState("Yea! All tasks completed successfully!");
            onEvent(UploadEvents.DONE, "Done processing " + actns.length + " tasks.");
            iIzDone();
            //closeFormIn(3000);
        }
    }
    public static final String xmlpath = "http://s3.amazonaws.com/NewPointeRoku/xml/";
    public static final String imgpath = "http://s3.amazonaws.com/NewPointeRoku/images/";
    public static final String hdvpath = "http://s3.amazonaws.com/NewPointeRoku/sdvideos/";
    public static final String sdvpath = "http://s3.amazonaws.com/NewPointeRoku/hdvideos/";

    private void generateXML() throws SQLException, ClassNotFoundException, InstantiationException, IllegalAccessException, IOException {
        if (scon.connect_throwerrors()) {

            tmpXmlFiles.clear();

            String currentSeriesxml = "1";

            List<String[]> seriesList = new ArrayList<>();
            List<String[]> messageList = new ArrayList<>();


            ResultSet seriesRslts = scon.runQuery("SELECT * FROM series where enabled = true ORDER BY endDate DESC;");

            while (seriesRslts.next()) {

                int numOfMsgs = 0;
                messageList.clear();

                String srsId = seriesRslts.getString("id");
                String srsName = seriesRslts.getString("seriesname");
                String srsDesc = seriesRslts.getString("description");
                java.sql.Date srsEndDt = seriesRslts.getDate("enddate");
                String srsFdURl = seriesRslts.getString("feedurl");
                String srsImgURL = seriesRslts.getString("imageurl");

                GregorianCalendar dt = new GregorianCalendar();
                dt.set(Calendar.DAY_OF_MONTH, dt.get(Calendar.DAY_OF_MONTH) - 9);

                if (dt.before(srsEndDt)) {
                    currentSeriesxml = srsFdURl;
                }

                seriesList.add(new String[]{srsName, srsDesc, srsFdURl});

                ResultSet messageRslts = scon.runQuery("SELECT * FROM message WHERE series_id = '" + srsId + "' ORDER BY date ASC;");

                while (messageRslts.next()) {
                    numOfMsgs++;

                    String messageid = messageRslts.getString("id");
                    String messagename = messageRslts.getString("name");
                    String date = messageRslts.getString("date");
                    String communicator = messageRslts.getString("communicator");
                    String runtime = messageRslts.getString("runtime");
                    String fileurl = messageRslts.getString("fileurl");
                    String fileurl2 = messageRslts.getString("fileurl2");

                    messageList.add(new String[]{messageid, messagename, date, communicator, runtime, fileurl, fileurl2, srsDesc});

                }

                File tmpfl = java.io.File.createTempFile(srsFdURl, null);

                String seriesfilexml = "";
                seriesfilexml = "<?xml version=\"1+0\" encoding=\"UTF-8\" standalone=\"yes\"?>" + "\n";
                seriesfilexml += "<feed>" + "\n";
                seriesfilexml += "<resultLength>" + numOfMsgs + "</resultLength>" + "\n";
                seriesfilexml += "<endIndex>" + numOfMsgs + "</endIndex>" + "\n\n";

                for (int msgn = 0; msgn < messageList.size(); msgn++) {
                    seriesfilexml += "<item sdImg=\"" + imgpath + srsImgURL + "\" hdImg=\"" + imgpath + srsImgURL + "\">" + "\n";
                    seriesfilexml += "<title>" + messageList.get(msgn)[1] + "</title>" + "\n";
                    seriesfilexml += "<contentId>" + messageList.get(msgn)[0] + "</contentId>" + "\n";
                    seriesfilexml += "<contentType>Talk</contentType>" + "\n";
                    seriesfilexml += "<contentQuality>HD</contentQuality>" + "\n";
                    seriesfilexml += "<streamFormat>mp4</streamFormat>" + "\n";
                    seriesfilexml += "<media>" + "\n";
                    seriesfilexml += "<streamQuality>SD</streamQuality>" + "\n";
                    seriesfilexml += "<streamBitrate>1500</streamBitrate>" + "\n";
                    seriesfilexml += "<streamUrl>" + sdvpath + messageList.get(msgn)[5] + "</streamUrl>" + "\n";
                    seriesfilexml += "</media>" + "\n";
                    seriesfilexml += "<media>" + "\n";
                    seriesfilexml += "<streamQuality>HD</streamQuality>" + "\n";
                    seriesfilexml += "<streamBitrate>5000</streamBitrate>" + "\n";
                    seriesfilexml += "<streamUrl>" + hdvpath + messageList.get(msgn)[6] + "</streamUrl>" + "\n";
                    seriesfilexml += "</media>" + "\n";
                    seriesfilexml += "<synopsis>Program Date: " + messageList.get(msgn)[2] + " Communicator: " + messageList.get(msgn)[3] + ".  " + messageList.get(msgn)[7] + " </synopsis>" + "\n";
                    seriesfilexml += "<genres>" + srsName + "</genres>" + "\n";
                    seriesfilexml += "<runtime>" + messageList.get(msgn)[4] + "</runtime>" + "\n";
                    seriesfilexml += "</item>" + "\n\n";
                }
                seriesfilexml += "</feed>" + "\n";


                try (Writer writer = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(tmpfl), "utf-8"))) {
                    writer.write(seriesfilexml);
                }

                tmpXmlFiles.add(tmpfl);
                tmpXmlFileNames.add(srsFdURl);

            }

            File tmpfl = java.io.File.createTempFile("categories.xml", null);

            String seriesfilexml = "";

            seriesfilexml = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>" + "\n";
            seriesfilexml += "<categories>" + "\n";
            seriesfilexml += "<category title=\"Live Stream\" description=\"Watch NewPointe Live on Sundays at 9:00am and 11:00am\" sd_img=\"" + imgpath + "live.png\" hd_img=\"" + imgpath + "live.png\">" + "\n";
            seriesfilexml += "<categoryLeaf title=\"Live Stream\" description=\"\" feed=\"" + xmlpath + "livestream.xml\"/>" + "\n";
            seriesfilexml += "</category>" + "\n";

            seriesfilexml += "<category title=\"Series and Messages\" description=\"Watch NewPointe messages\" sd_img=\"" + imgpath + "pastseries.png\" hd_img=\"" + imgpath + "pastseries.png\">" + "\n";

            for (int srs = 0; srs < seriesList.size(); srs++) {
                seriesfilexml += "<categoryLeaf title=\"" + seriesList.get(srs)[0] + "\" description=\"" + seriesList.get(srs)[1] + "\" feed=\"" + xmlpath + "" + seriesList.get(srs)[2] + "\"/>" + "\n";
            }

            seriesfilexml += "</category>" + "\n";
            seriesfilexml += "</categories>";


            try (Writer writer = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(tmpfl), "utf-8"))) {
                writer.write(seriesfilexml);
            }

            tmpXmlFiles.add(tmpfl);
            tmpXmlFileNames.add("categories.xml");


        } else {
            throw new SQLException("Could not connect to SQL database.");
        }
    }

    public void iIzDone() {
        JOptionPane.showMessageDialog(this, "All tasks completed successfully!", "Done!", JOptionPane.INFORMATION_MESSAGE);
        this.getOwner().dispose();
        closeForm();
    }

    public void iGotzAnErrar(int step, Exception ex) {

        String msgTxt = "Oh noes! An error occured on step " + step + ". \n\n";

        msgTxt += " Error: " + ex.getMessage() + "\n";

        Throwable csdBy = ex.getCause();
        if (csdBy != null) {
            msgTxt += " Caused By: " + csdBy.getMessage() + "\n";
            while (csdBy.getCause() != null) {
                csdBy = csdBy.getCause();
                msgTxt += " Caused By :" + csdBy.getMessage() + "\n";
            }
        }

        JOptionPane.showMessageDialog(this, msgTxt, "Uh oh!", JOptionPane.ERROR_MESSAGE);
        closeForm();
    }

    public void closeForm() {
        this.dispose();
    }

    public void closeFormIn(int milliseconds) {
        GregorianCalendar dt = new GregorianCalendar();
        dt.add(Calendar.MILLISECOND, milliseconds);

        while ((new GregorianCalendar()).before(dt)) {
        }

        closeForm();
    }

    public class ActionFailedException extends Exception {

        ActionFailedException(String message) {
            super(message);
        }

        ActionFailedException(String message, Throwable cause) {
            super(message, cause);
        }
    }

    public void setShortProgressState(String caption) {
        jLabel1.setText(caption);
        jProgressBar1.setIndeterminate(true);
    }

    public void setLongProgressState(String caption) {
        jLabel2.setText(caption);
        //jProgressBar2.setIndeterminate(true);
    }

    public void setShortProgressState(String caption, int progress, int ofTotal) {
        jLabel1.setText(caption);
        jProgressBar1.setValue(progress);
        jProgressBar1.setMaximum(ofTotal);
        jProgressBar1.setIndeterminate(false);
    }

    public void setLongProgressState(String caption, int progress, int ofTotal) {
        jLabel2.setText(caption);
        //jProgressBar2.setValue(progress);
        //jProgressBar2.setMaximum(ofTotal);
        //jProgressBar2.setIndeterminate(false);
    }

    public enum actionevents {

        UPLOAD_FILE,
        RUN_SQL,
        GENERATE_XML,
        UPLOAD_XML
    }

    private class Flchng implements ProgressListener {

        JProgressBar progBar;
        int progTotal;

        public Flchng(JProgressBar p, int t) {
            progBar = p;
            progTotal = t;
            progBar.setMaximum(t);
        }

        @Override
        public void progressChanged(ProgressEvent progressEvent) {
            progBar.setValue(progBar.getValue() + progressEvent.getBytesTransfered());
        }
    }
    /////////////////////////
    //        Events       //
    /////////////////////////
    private List<UploadEventHandler> eventHandlers = new ArrayList();

    public void registerEventHandler(UploadEventHandler handler) {
        eventHandlers.add(handler);
    }

    public void unregisterEventHandler(UploadEventHandler handler) {
        eventHandlers.remove(handler);
    }

    private synchronized void onEvent(UploadEvents evt, String message) {
        for (int eh = 0; eh < eventHandlers.size(); eh++) {
            eventHandlers.get(eh).onEvent(evt, message);
        }
    }

    public interface UploadEventHandler {

        public void onEvent(UploadEvents evt, String message);
    }

    public enum UploadEvents {

        BEGIN,
        FILE_UPLOADED,
        SQL_RUN,
        XML_GENERATED,
        XML_UPLOADED,
        DONE,
        ERROR
    }
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JList jList1;
    private javax.swing.JPanel jPanel1;
    private javax.swing.JPanel jPanel2;
    private javax.swing.JProgressBar jProgressBar1;
    private javax.swing.JScrollBar jScrollBar1;
    private javax.swing.JScrollPane jScrollPane1;
    // End of variables declaration//GEN-END:variables
}
