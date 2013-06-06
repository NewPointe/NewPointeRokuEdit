/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function setUpForm(formData){
    for(var i = 0; i < formData.length; i++){
        fld = document.getElementById(formData[i]);
        //fld.required = true;
        fld.name = formData[i];
        fld.value = "";
        fld.onblur = function () { validateInput(this);};
        fld.onchange = function () { validateInput(this);};
        fld.onkeyup = function () { validateInput(this);};
    }
}


function validateInput(inputObject) {
    if(inputObject.value !== "" && inputObject.value !== null){
        inputObject.style.backgroundColor = "#B2FFB2";
        return true;
    }
    else {
        inputObject.style.backgroundColor = "#FFAD98";
        return false;
    }
}

function validateAllInput(ids){
    try{
        console.log('validating');
        a = false;
        for(var i = 0; i < ids.length; i++){
            fld = document.getElementById(ids[i]);
            b = validateInput(fld);
            a = a && b;
        }
        
        if(a){
            showBox("<h3>Uploading files, please stay on this page untill the upload is complete!</h3><br /><img src='res/img/ajax-loader.gif' />");
        }
        
        return a;
    }
    catch(e){
        return false;
    }
}

function showBox(content) {
    box = document.createElement('div');
    box.setAttribute('class', 'popBox');
    box.setAttribute('id', "popBox" + Math.random());
    
    boxContent = document.createElement('div');
    boxContent.setAttribute('class', 'popBoxContent');
    
    boxContent.innerHTML = content;
    document.body.appendChild(box);
    document.body.appendChild(boxContent);
    
}