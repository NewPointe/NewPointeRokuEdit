//==========================================================
//
//  Created By: Tschrock
//  Description: Adds a stylable file input to forms.
//  
//  Usage: newFileInStyle(<divId>, <CaptionText>, <AlowedInput>[, <BoxHeight>[, <BoxWidth>]]);
//
//  Example: newFileInStyle("fileIn", "Add an Image", "image/*", 200, 300);
//
//==========================================================

function newFileInStyle(id, txt, accept, height, width) {
    
    //get a reference to the container element and add the style class
    container = document.getElementById(id);
    container.classList.add("fileInStyleMainPan")
    
    //create a pannel for the visual styling
    stylePannel = document.createElement('div');
    stylePannel.id = id + "StylePannel";
    stylePannel.className = "fileInStyleStylePan";
    
    //create a header pannel for the text
    stylePannelTextPannel = document.createElement('h4');
    stylePannelTextPannel.id = id + "stylePannelTextPannel";
    stylePannelTextPannel.className = "fileInStyleStylePanTxt";
    
    //put the text to a text node
    stylePannelText = document.createTextNode(txt);
    
    //add the text node to the header pannel, and the header pannel to the style pannel
    stylePannelTextPannel.appendChild(stylePannelText);
    stylePannel.appendChild(stylePannelTextPannel);
    
    //create a preview pannel to hold the file preview
    previewPannel = document.createElement('div');
    previewPannel.id = id + "PreviewPannel";
    previewPannel.className = "fileInStylePreviewPan";
    
    //create an input pannel; this deal with all the file actions
    inputPannel = document.createElement('input');
    inputPannel.type = "file";
    inputPannel.id = id + "InputPannel";
    inputPannel.name = id + "InputPannel";
    inputPannel.className = "fileInStyleInputPan";
    inputPannel.accept = accept;
    
    //add all 3 main pannels to the container
    container.appendChild(stylePannel);
    container.appendChild(previewPannel);
    container.appendChild(inputPannel);
    
    //set up the preview pannel
    if(accept == 'image/*'){
        preview = document.createElement('img');
        preview.id = id + "Preview";
        preview.className = "fileInStylePreview";
        previewPannel.appendChild(preview);
        inputPannel.setAttribute("data-previewId", preview.id)
        inputPannel.onchange = function (e) { fileInStyle_dispImg(e) };
    }
    else if(accept == 'video/*'){
        preview = document.createElement('video');
        preview.setAttribute("id", id + "Preview");
        preview.setAttribute("class", "fileInStylePreview");
        previewPannel.appendChild(preview);
        inputPannel.setAttribute("data-previewId", preview.id)
        inputPannel.onchange = function (e) { fileInStyle_dispVid(e); };
    }
    else{
    }
    
    //dynamicaly adjust the style if custom height or width is specified
    if(height){
        container.style.height = height + "px";
        previewPannel.style.marginTop = (-height) + "px";
        previewPannel.style.height = (height-10) + "px";
        if(accept == 'image/*' || accept == 'video/*'){
            preview.style.maxHeight = (height-5) + "px";
        }
        stylePannel.style.height = (height-10) + "px";
        inputPannel.style.height = (height-10) + "px";
        inputPannel.style.marginTop = -(height-5) + "px";
    }
    if(width){
        container.style.width = width + "px";
        previewPannel.style.width = (width-10) + "px";
        if(accept == 'image/*' || accept == 'video/*'){
            preview.style.maxWidth = width + "px";
        }
        stylePannel.style.width = (width-10) + "px";
        inputPannel.style.width = (width-10) + "px";
        
    }
    
    //all done!

}

function fileInStyle_dispImg(e) {
    inputObject = e.target;
    if (inputObject.files && inputObject.files[0]) {
        var reader = new FileReader();
        reader.inputObject = inputObject;
        reader.onload = function (e) {
            imgTag = document.getElementById(this.inputObject.getAttribute("data-previewId"));
            imgTag.src = e.target.result;
            imgTag.parentNode.style.opacity = "1";
        };

        reader.readAsDataURL(inputObject.files[0]);
    }
}
 
function fileInStyle_dispVid(e) {
    inputObject = e.target;
    if (inputObject.files && inputObject.files[0]) {
        var URL = window.URL || window.webkitURL;
        var fileURL = URL.createObjectURL(inputObject.files[0]);
        vidTag = document.getElementById(inputObject.getAttribute("data-previewId"));
        vidTag.setAttribute("oncanplay", "event.target.currentTime = 10;");
        
        vidTag.src = fileURL;
        vidTag.parentNode.style.opacity = "1";
    }
}
