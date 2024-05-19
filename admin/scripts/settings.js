
let general_data, contacts_data;

let general_s_form = document.getElementById('general_s_form');
let site_title_input = document.getElementById('site_title_input');
let site_about_input = document.getElementById('site_about_input');

let contacts_s_form = document.getElementById('contacts_s_form');

let team_s_form = document.getElementById('team_s_form');
let member_name_inp = document.getElementById('member_name_inp');
let member_picture_inp = document.getElementById('member_picture_inp');

function get_general (){ //tai du lieu
    let site_title = document.getElementById('site_title');
    let site_about = document.getElementById('site_about');


    let shutdown_toggle = document.getElementById('shutdown-toggle');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');//chi dinh loai noi dung dc gui 

    xhr.onload = function(){
        general_data = JSON.parse(this.responseText);//chuyen dinh dang JSON thanh file JS

        site_title.innerText = general_data.site_title;
        site_about.innerText = general_data.site_about;

        site_title_input.value = general_data.site_title_input;
        site_about_input.value = general_data.site_about_input;

        if(general_data.shutdown == 0 ){
            shutdown_toggle.checked = false;
            shutdown_toggle.value = 0;
        }
        else {
            shutdown_toggle.checked = true;
            shutdown_toggle.value = 1;
        }
    }
    xhr.send('get_general');//gui yeu cau AJAX
}

general_s_form.addEventListener('submit', function(e){
    e.preventDefault();//ko bo trong du lieu nhap vao
    upd_general(site_title_input.value, site_about_input.value);
});

function upd_general(site_title_val, site_about_val){//cap nhat du lieu
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        var myModal = document.getElementById('general-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        if(this.responseText == 1){
            alert('success','Changes saved!');
            get_general();
        }
        else {
            alert('error','No changes made!');
        }
    }
    xhr.send('site_title='+site_title_val+'&site_about='+site_about_val+'&upd_general');//gui URL
}

function upd_shutdown(val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        if(this.responseText == 1 && general_data.shutdown==0){
            alert('success','Site has been shutdown!');
        }
        else {
            alert('success','Shutdown mode off!');
        }
        get_general();
    }
    xhr.send('upd_shutdown='+val);
}


function get_contacts (){ 
    let contacts_p_id = ['address', 'gmap', 'pn1', 'pn2', 'email', 'fb', 'twt', 'ins'];
    let iframe = document.getElementById('iframe');
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');//chi dinh loai noi dung dc gui 

    xhr.onload = function(){
        contacts_data = JSON.parse(this.responseText);//chuyen dinh dang JSON thanh file JS
        contacts_data = Object.values(contacts_data);

        console.log(typeof(contacts_data));
        console.log(contacts_data);

        for (i=0;i<contacts_p_id.length;i++){
            document.getElementById(contacts_p_id[i]).innerText = contacts_data[i+1];
        }
        iframe.src = contacts_data[9];
        contacts_inp(contacts_data);
    }
    
    xhr.send('get_contacts');
}

function contacts_inp(data){
    let contacts_inp_id = ['address_inp', 'gmap_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'fb_inp', 'twt_inp', 'ins_inp','iframe_inp'];
    for (i=0; i<contacts_inp_id.length;i++){
        document.getElementById(contacts_inp_id[i]).value = data[i+1];
    }

}

contacts_s_form.addEventListener('submit', function(e){
    e.preventDefault();
    upd_contacts();
});

function upd_contacts(){
    let index = ['address', 'gmap', 'pn1', 'pn2', 'email', 'fb', 'twt', 'ins','iframe'];
    let contacts_inp_id =  ['address_inp', 'gmap_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'fb_inp', 'twt_inp', 'ins_inp','iframe_inp'];

    let data_str = "";
    for (i=0;i<index.length;i++){
        data_str += index[i]+  "=" + document.getElementById(contacts_inp_id[i]).value + '&';
    }
    data_str += "upd_contacts";

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        var myModal = document.getElementById('contacts-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        
        if(this.responseText == 1){
            alert('success', 'Save changes!');
            get_contacts();
        }
        else {
            alert('error', 'No change made');
            console.log(this.responseText);
        }
    }
    xhr.send(data_str);
}

team_s_form.addEventListener('submit', function(e){
    e.preventDefault();
    add_member();
})

function add_member(){
    let data = new FormData();
    data.append('name', member_name_inp.value);
    data.append('picture', member_picture_inp.files[0]);
    data.append('add_member', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);

    xhr.onload = function(){
        var myModal = document.getElementById('team-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.response == 'inv_img'){
            alert('error', 'Please upload JPG, JPEG, PNG, WEBP file only');
        }
        else if(this.responseText == 'inv_size'){
            alert('error', 'Image size less than 2MB');
        }
        else if(this.responseText == 'upd_failed'){
            alert('error', 'Fail to upload image');
        }
        else {
            alert('success', 'New member has been added');
            member_name_inp.value = '';
            member_picture_inp.value = '';
            get_members();
        }
    }
    xhr.send(data);
}

function get_members(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('team-data').innerHTML = this.responseText;
    }
    xhr.send('get_members');
}

function rem_members(val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');//chi dinh loai noi dung dc gui 

    xhr.onload = function(){
        if (this.responseText == 1){
            alert('success', 'Member removed');
            get_members();
        }
        else {
            alert('error', 'Remove action can not be made');
        }
    }
    xhr.send('rem_members='+val);
}

window.onload = function(){
    get_general();
    get_contacts();
    get_members();
}