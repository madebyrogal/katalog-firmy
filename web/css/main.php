<?php ob_start ("ob_gzhandler"); header("Content-type: text/css; charset: UTF-8"); header("Cache-Control: must-revalidate"); $offset = 60 * 60 ; $ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT"; header($ExpStr); ?>
body, html {
    margin: 0;
    padding: 0;
    background: #87e0fd; /* Old browsers */
    background: -moz-linear-gradient(top, #87e0fd 0%, #ffffff 56%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#87e0fd), color-stop(56%,#ffffff)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, #87e0fd 0%,#ffffff 56%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, #87e0fd 0%,#ffffff 56%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, #87e0fd 0%,#ffffff 56%); /* IE10+ */
    background: linear-gradient(to bottom, #87e0fd 0%,#ffffff 56%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#87e0fd', endColorstr='#ffffff',GradientType=0 ); /* IE6-9 */
    color: #072f53;
    font: 13px Arial;
    line-height: 20px;
}



#facebook {
    width: 49px;
    height: 59px;
    background: url(../images/facebook.png) no-repeat;
    position: fixed;
    top: 125px;
    cursor: pointer;
    left: 0px;
    z-index: 100;
}

#facebook_content {
    width: 310px;
    height: 280px;
    background: #2554ac;
    position: fixed;
    top: 125px;
    z-index: 10;
    left: -325px;
    padding-top: 20px;
    padding-left: 15px;
}

#default_name, #default_place {
    display: none;
}

#logo {
    position: absolute;
    top: 30px;
    left: 10px;
}

#logo h1 {
	margin: 0px;
}

#page {
    width: 980px;
    min-width: 980px;
    max-width: 980px;
    margin: 0 auto;
    /*background: url(../images/top.png) repeat-x;*/
    min-height: 400px;
}

#top {
    height: 113px;
    width: 980px;    
    overflow: hidden;
    position: relative;
    margin-bottom: 15px;
}

#search {
    overflow: hidden;
    clear: both;
    width: 980px;
    height: 85px;
    background: url(../images/search_center.png) repeat-x;
    margin-bottom: 22px;
}

.search_left {
    overflow: hidden;
    width: 9px;
    height: 85px;
    /*background: url(../images/search_left.png) no-repeat;*/
    background: url(../images/sprite.png) no-repeat;
    background-position: -585px -42px ;
    float: left;
}

.search_right {
    overflow: hidden;  
    width: 10px;
    height: 85px;
    /*background: url(../images/search_right.png) no-repeat;*/
    background: url(../images/sprite.png) no-repeat;
    background-position: -602px -42px ;
    float: right;
}


.search_center {
    overflow: hidden;
    height: 85px;
    width: 961px;
    float: left;
    position: relative;
}

.search_text {
    font: bold 22px Arial;
    color: #fff;
    position: absolute;
    top: 15px;
    left: 20px;
}

.search_text span {
    font: bold 16px Arial;
}

#search input[type="text"] {
    position: absolute;
    border: 0;
    /*background: url(../images/search_input.png) no-repeat;*/
    background: url(../images/sprite.png) no-repeat;
    background-position: -209px -40px ;
    width: 307px;
    padding: 8px;   
    padding-bottom: 7px;
    color: #7c93ad;
    font-size: 16px;
}

#search_name {
    top: 12px;
    left: 120px;
}

#search_place {
    top: 12px;
    left: 470px;
}

#search input[type="submit"] {
    border: 0;
    cursor: pointer;
    width: 96px;
    height: 33px;
    /*background: url(../images/search_button.png) no-repeat;*/
    background: url(../images/sprite.png) no-repeat;
    background-position: -178px -75px ;
    position: absolute;
    top: 14px;
    right: 45px;
}    

.search_text_e {
    font: normal 12px Arial;
    color: #fff;
    position: absolute;
    
}

.search_text_1 {
    top: 50px;
    left: 140px;
}

.search_text_2 {
    top: 50px;
    left: 490px;
}

.left {
    width: 260px;
    float: left;
}

.right {
    width: 718px;
    float: right;
    position: relative;
}

#search_content {
    overflow: hidden;
    clear: both;
    position: relative;
    /*padding-top: 15px;*/
}

#search_background {
   width: 100%;
   height: 400px;
   position: absolute;
   z-index: 1000;
   background: #f6f6f6;
   top: 0;
   -khtml-opacity:.90;
   -moz-opacity:.90;
   -ms-filter:"alpha(opacity=90)";
   filter:alpha(opacity=90);
   opacity:.90;
   display: none;
}

#content {
    width: 980px;
    background: url(../images/content.png) repeat-y;
    border-bottom: 1px solid #e9e9e9;
    min-height: 200px;
    overflow: hidden;
    clear: both;
    position: relative;
}

.h_menu {
    /*background: url(../images/categories.png) #fff no-repeat !important;*/
    background: url(../images/sprite.png)  #fff no-repeat !important;
    background-position: 0px -41px  !important;
    padding-left: 42px !important;
    width: 166px !important;

}

.header {    
    height: 23px;
    margin: 0;
    padding: 0;
    font: bold 13px Arial;
    color: #fff;
    padding-top: 5px;
    padding-left: 20px;
    border-bottom: 1px solid #e9e9e9;
    background: url(../images/header.png) #fff no-repeat;
    background-position: left;         
    position: relative;
    width: 697px;
}

.header_left {
    left: 1px;
    z-index: 10;
}

#footer {
    width: 980px;
    height: 135px;
    margin-top: 10px;
    margin-bottom: 4px;
}

.footer_left {
    /*background: url(../images/footer_left.png) no-repeat;*/
    background: url(../images/sprite.png) no-repeat;
    background-position: -591px -132px ;
    float: left;
    height: 135px;
    width: 10px;
}

.footer_right {
    /*background: url(../images/footer_right.png) no-repeat;*/
    background: url(../images/sprite.png) no-repeat;
    background-position: -603px -132px ;
    float: right;
    height: 135px;
    width: 10px;
    
}

.footer_center {
    width: 960px;
    background: url(../images/footer_center.png) repeat-x;
    height: 135px;
    float: left;
    position: relative;
}

.company_left .company_one_address {
    width: 230px;
    position: relative;
    top: 0;
}

.company_left .company_one_button {
    position: relative;
    top: 5px;
}

.company_one {
    min-height: 125px;
    width: 708px;
    margin-bottom: 10px;
    position: relative;
    padding-top: 10px;
    padding-bottom: 10px;
}

.comapny_one_logo {
    position: absolute;
    left: 5px;
}

.company_one_address {
    position: absolute;
    left: 150px;
    top: 10px;
    font: 13px Arial;
    color: #022448;
    width: 340px;
}

.company_one_name, .company_one_name a {
    font: bold 14px Arial;
    color: #022448;
    display: block;
    margin-bottom: 3px;
    text-decoration: none;
    line-height: 21px;
}

.company_one_button {
    position: absolute;
    left: 150px;
    top: 90px;
    display: block;
    /*background: url(../images/contact.png) no-repeat;*/
    background: url(../images/sprite.png) no-repeat;
    background-position: -276px -76px ;
    width: 163px;
    height: 40px;
}

.company_one_more {
    position: absolute;
    left: 150px;
    top: 103px;
    display: block;
    color: #022448;
    text-decoration: none;
    font: bold 14px Arial;
}

.company_one_owns {
    position: absolute;
    left: 500px;
    top: 17px;
    width: 190px;
}

.company_one_owns img {
    margin-bottom: 10px;
}

.company_one_owns_head {    
    display: block;
    color: #fd8a28;
    font: bold 14px Arial;
    margin-bottom: 15px;
}

.company_one_owns hr {
    background: none;
    border: 0;
    border-bottom: 1px dotted #000;    
}

.company_one_hr {
    width: 704px;
    border: 1px solid #e9e9e9;
}

.comapny_one_promoted {
/*    background: #ffefdc; */
}

.comapny_one_promoted .company_one_more {
    left: 330px;
}

/* menu : start */

#menu {
    width: 614px;
    height: 40px;
    /*background: url(../images/menu.png) no-repeat;*/
    background: url(../images/sprite.png) no-repeat;
    position: absolute;
    top: 33px;
    right: 0px;
}

.menu_top ul {
    margin: 0;
    padding: 0;
    clear: both;
}

.menu_top ul li {
    margin: 0;
    padding: 0;
    list-style: none;
    display: inline;    
    float: left;
}

.menu_top ul li a {
    display: block;
    float: left;
    width: 153px;
    text-align: center;
    color: #fff;
    font: bold 14px Arial;
    text-decoration: none;
    padding-top: 12px;
}

.menu_top ul li a:focus {
    outline:none;
}

/* menu : stop */

.top_text {
    font: 12px Arial;
    color: #1c3a5c;
    background: url(../images/arrow.png) no-repeat;
    background-position: left center;
    padding-left: 12px;
    position: absolute;
    top: 80px;
    right: 0;
}

.top_text span {
    color: #ffa200;
    font-weight: bold;
}

.menu_category, .menu_category ul {
    margin: 0;
    padding: 0;    
}

.menu_category li {
    margin: 0;
    padding: 0;  
    list-style: none;
    padding-top: 2px;
    padding-bottom: 2px;
    border-bottom: 1px solid #e8e8e8;
}

.menu_category li a {
    color: #007bd4;
    text-decoration: none;
    font: 13px Arial;
    padding-top: 5px;
    padding-bottom: 5px;
    display: block;
    background: url(../images/menu_arrow.png) no-repeat;
    background-position: left center;
    padding-left: 26px;
}    

.menu_category li a:hover, .menu_category li a.active {
    color: #045189;
    background: url(../images/menu_arrow.png) #d8ecfa no-repeat;
    background-position: left center;
}

.partners {
    margin-top: 8px;
    clear: both;
    overflow: hidden;
}

.partners table {
    width: 980px;    
}

.partners table td {
    text-align: right;
    min-width: 250px;
}

.partners table td span {
    font: 18px Arial;
    color: #0b2b4f;
}

.clear {
    clear: both;
}

.f_left {
    float: left;
    font: 11px Arial;
    color: #8e8a8a;
}

.f_right {
    float: right;
    color: #6f6666;
    font: 11px Arial;
    margin-bottom: 10px;
}

.f_right a {
    text-decoration: none;
    font-weight: bold;
    color: #015eab;
    margin-bottom: 10px;
}

#footer_box_1 {
    width: 420px;
    position: absolute;
    left: 20px;
}

#footer_box_2 {
    width: 220px;
    position: absolute;
    left: 460px;
}

#footer_box_3 {
    width: 200px;
    position: absolute;
    left: 750px;
}

.footer_center h4 {
    font: 16px Arial;
    color: #0b2b4f;
    margin: 0;
    padding: 0;
    margin-top: 8px;
    margin-bottom: 15px;
}

.footer_center ul {
    margin: 0;
    padding: 0;
    margin-left: 15px;
}

.footer_center ul li {
    list-style-image: url(../images/menu_bottom_arrow.png);
    width: 180px;
    float: left;
}

.footer_center ul li a {
    color: #0b2b4f;
    text-decoration: none;
    font: 13px Arial;
}    

.footer_center ul li a:hover {
    text-decoration: underline;
}

.footer_center ul li ul {
    display: none;
}

.tel1, .tel2 {
    font: 20px Arial;
    color: #fd902f;
    position: absolute;
}

.tel1 {
    
}

.tel2 {
    left: 150px;
} 

.tel1_text {
    font: 14px Arial;
    color: #0b2b4f;
    position: absolute;
    top: 70px;
}

.tel2_text {
    font: 14px Arial;
    color: #0b2b4f;
    position: absolute;
    top: 70px;
    left: 150px;
}

.footer_email {
    font: bold 13px Arial;
    color: #87cfe3;
    position: absolute;
    top: 100px;
}

.footer_email a {
    color: #0b2b4f;
    font-weight: normal;
}

.sliderbutton_left, .sliderbutton_right {
    cursor: pointer;
}



.sliderbutton_left {
    background: url(../images/slider_left.png) no-repeat;
    width: 36px;
    height: 150px;
    display: block;
    float: left;
}

.sliderbutton_right {
    background: url(../images/slider_right.png) no-repeat;
    width: 19px;
    height: 150px;
    display: block;
    right: 0;
    position: absolute;    
}

#slider_1 .sliderbutton_left, #slider_1 .sliderbutton_right {
    display: none !important;
}

.jFlowButtons {
    text-align: right;
}

#slider_1 {
    position: relative;
    margin-bottom: 0px;
    margin-top: 10px;
}

.jFlowButtons {
    position: absolute;
    z-index: 10000;
    right: 20px;
    top: 10px;
}

.jFlowButton {
    cursor: pointer;
    padding-left: 7px;
    padding-right: 5px;
    padding-top: 2px;
    padding-bottom: 2px;
    margin: 2px;
    background: #f5f7f8;
    border: 1px solid #e7e7e7;
    color: #034a7f;
    text-align: center;
    font-weight: bold;
}

.jFlowActive {
    background: #fcb664;
    border: 1px solid #ff9c00;
    color: #fff;
}

.company_show {
    margin-left: 20px;
    padding-top: 10px;
    overflow: hidden;
    clear: both;
    margin-right: 10px;
    padding-bottom: 20px;
}

.company_show h1 {
    font: bold 24px Arial; 
    color: #002448;
}

.company_left {
    width: 55%;
    float: left;
}

.company_right {
    width: 43%;
    float: right;
}

.company_show h2 {
    font: bold 16px Arial; 
    color: #002448;
    border-bottom: 1px solid #dedfe3;
    padding-bottom: 5px;
}

.company_show .description {
    color: #032950;
    font: 12px Arial;
    line-height: 21px;
    overflow: hidden;
    clear: both;
}

.company_show .description p {
    margin-top: 2px;
}

.statsForm {
    padding: 8px;
    border: 1px solid #e4e8eb;
}

.statsForm input, .statsForm textarea {
    border: 1px solid  #e4e8eb;
    font: 12px Arial;
    color: #1c385f;
    padding: 4px;
    width: 250px;
}

.statsForm textarea {
    height: 120px;
}

.statsForm .send {
    background: url(../images/send.png) no-repeat;
    border: 0;
    width: 88px;
    height: 25px;
    margin-left: 180px;
}

.category_choose a {
    font: bold 13px Arial;
    color: #082f50;
    text-decoration: none;
}

.category_choose a:hover {
    text-decoration: underline;
}
/*
.sliderbutton_left {
    width: 36px;
    height: 150px;
    background: url(../images/slider_left.png) no-repeat;
    display: block;
    position: absolute;
    cursor: pointer;
    z-index: 10000;
}

.sliderbutton_right {
    width: 36px;
    height: 150px;
    background: url(../images/slider_right.png) no-repeat;
    display: block;
    position: absolute;
    cursor: pointer;
    right: 0;
    z-index: 10000;
}*/

#jFlowSlide {
    float: left;
    margin-left: 5px;
}

#slider_gallery {
    position: relative;
    
}

.jFlowSlideContainer {
    float: left;
}

/* popup: start */

#company_one_popup {
    display: none;
    width: 450px;
    height: 197px;
    background: url(../images/popup.png) no-repeat;
    position: absolute;
    z-index: 10000;
}

.stats_popup {
    position: relative;
}

.popup_close {
    position: absolute;
    top: 10px;
    right: 10px;
    font: 12px Arial;
    text-decoration: none;
    color: #02254b;
}

.popup_close span {
    color: #f65857;
}

.popup_email_text {
    font: 13px Arial;
    color: #02254b;
    position: absolute;
    top: 40px;
    left: 30px;
}

.stats_popup input[type="text"] {
    width: 290px;
    border: 1px solid #e5e5e5;
    font: 14px Arial;
    padding: 6px;
    position: absolute;
    top: 60px;
    left: 30px;
}

.stats_popup input[type="button"] {
    width: 34px;
    height: 28px;
    background: url(../images/ok.png) no-repeat;
    border: 0;
    position: absolute;
    top: 62px;
    left: 340px;
    cursor: pointer;
}

.popup_error {
    font: bold 13px Arial;
    color: red;
    position: absolute;
    top: 13px;
    left: 30px;    
    display: none;
}

#popup_company {
    display: none;
}

.popup_text {
    font: 12px Arial;
    color: #8e9ab0;
    position: absolute;
    top: 100px;
    left: 30px;
    display: block;
    width: 350px;
}

.stats_popup h1 {
    position: absolute;
    top: 25px;
    left: 30px;
    font: bold 20px Arial;
    margin: 0;
    padding: 0;
    color: #03254b;
}

.stats_popup table {
    position: absolute;
    top: 60px;
    left: 30px;
    font: 13px Arial;
    color: #03254b;
    line-height: 20px;
}

.stats_popup table td {
    width: 170px;
}

.loading {
    position: absolute;
    top: 5px;
    left: 5px;
    display: none;
}

/* popup: stop */

.register_box {
    width: 240px;
    border: 1px solid #e7e8ea;
    padding-top: 10px;
    padding-bottom: 10px;    
    text-align: center;
    background: #eef0f3;
}

.register_box h1 {
    color: #152b40;
    font: bold 22px Arial;
    margin: 0;
    padding: 0;
}

.register_box a {
    color: #00bad9;
    font: 20px Arial;
}

.register_box span {
    display: block;
    margin-bottom: 5px;
    margin-top: 5px;
    font: bold 12px Arial;
    color: #152b40;
}

.login_box {
    margin-left: 20px;
}

.login_box form input[type="text"], .login_box form input[type="password"] {
    border: 1px solid #e6e6e6;
    width: 300px;
    font: 14px Arial;
    padding: 4px;
    margin-bottom: 7px;
}

.login_box form label, .login_box form a, .login_box {
    color: #0f2650;
    font: 14px Arial;
}

.login_button {
    width: 87px;
    height: 28px;
    border: 0;
    background: url(../images/login.png) no-repeat;
    margin-left: 10px;
    cursor: pointer;
}

.contact h2 {
    font: bold 20px Arial;
    color: #0f2650;
    text-align: center;
    margin-top: 25px;
}

.contact_box {
    width: 400px;
    min-width: 400px;
    max-width: 400px;
    margin: 0 auto;
    overflow: hidden;  
    
}

.sendEmails span {
    color: #0f2650;
    font: 14px Arial;
}


.sendEmails input[type="text"] {
    border: 1px solid #e6e6e6;
    width: 380px;
    font: 14px Arial;
    padding: 4px;
    margin-bottom: 7px;
    margin-top: 7px;
}

.sendEmails textarea {
    border: 1px solid #e6e6e6;
    width: 380px;
    font: 14px Arial;
    padding: 4px;
    margin-bottom: 7px;
    margin-top: 7px;
    height: 200px;
}

#form_captcha {
    width: 100px;
}
.send {
    width: 88px;
    height: 25px;
    border: 0;
    background: url(../images/send.png) no-repeat;
    cursor: pointer;
}


.article_box {
    padding-left: 30px;
    padding-right: 30px;
    padding-top: 10px;
}


.article_box h1 {
    font: bold 18px Arial;
    color: #0d2951;
    border-bottom: 1px solid #e9e9e9;    
    padding-bottom: 5px;
}

.clear_header {
    height: 28px;
    margin: 0;
    padding: 0;    
    border-bottom: 1px solid #e9e9e9;    
    position: relative;    
    left: 1px;
    z-index: 50;
    background: #fff;
}

.pagination a {
    text-decoration: none;
}

.pagination .page_link, .pagination .page_active {
    padding-left: 6px;
    padding-right: 7px;
    border: 1px solid #d1d2d6;
    color: #01294d;
    position: relative;
    top: -4px;
    padding-top: 2px;
    padding-bottom: 2px;
}

.pagination .page_active {
    background: #d3d7e0;
}

.packetTable {
    width: 771px;
    min-width: 771px;
    max-width: 771px;
    margin: 0 auto;
    border: 0;
}

.packetTable th {
    font-size: 20px;
}

.packetTable th span {
    font-size: 12px;
}

.packet_th1 {
    width: 152px;
    background: url(../images/packet_top_1.png) no-repeat;
    height: 64px;
    background-position: top center;    
}

.packet_td_bottom {
    width: 152px;
    background: url(../images/packet_td_bottom.png) no-repeat;
    height: 64px;
    background-position: top center;  
    text-align: center;
}

.packet_th2 {
    width: 184px;
    background: url(../images/packet_top_2.png) no-repeat;
    height: 64px;
    background-position: top center;
    line-height: 16px;
}

.packetTable td {
    height: 58px;
}

.packet_td_1 {
    background: url(../images/packet_td_1.png) no-repeat;
    padding-left: 20px;
}

.packet_td_1_1 {
    background: url(../images/packet_td_1_1.png) no-repeat;
    padding-left: 20px;
}

.packet_td_2 {
    background: url(../images/packet_td_2.png) no-repeat;
    text-align: center;
}

.packet_td_2_1 {
    background: url(../images/packet_td_2_1.png) no-repeat;
    text-align: center;
}

.packet_td_3 {
    background: url(../images/packet_td_3.png) no-repeat;
    text-align: center;
}

.packet_td_3_1 {
    background: url(../images/packet_td_3_1.png) no-repeat;
    text-align: center;
}

.packet_span {
    color: #fff;
}

.max_box {
    width: 850px;
    min-width: 850px;
    max-width: 850px;
    margin: 0 auto;
    overflow: hidden;
    padding-top: 20px;
    padding-bottom: 20px;
}

#formAddComapny input[type="text"], #formAddComapny input[type="password"] {
    
}

/* panel : start */

.panel_box {
    width: 900px;
    min-width: 900px;
    max-width: 900px;
    border: 1px solid #e9e9e9;
    margin: 0 auto;
    padding: 20px;
    margin-bottom: 20px;
}

.panel_menu {
    margin: 0;
    padding: 0;
    width: 940px;
    min-width: 940px;
    max-width: 940px;
    margin: 0 auto;
    overflow: hidden;
    clear: both;
    margin-top: 25px;
}

.panel_menu li {
    margin: 0;
    padding: 0;
    list-style: none;
    float: left;
}

.panel_menu li a {
    display: block;
    float: left;
    width: 159px;
    height: 25px;
    background: url(../images/panel_menu.png) no-repeat;
    background-position: bottom;
    margin-left: 3px;
    margin-right: 3px;
    color: #fff;
    text-decoration: none;
    text-align: center;
    padding-top: 10px;
}

.panel_menu li a.active {
    background: url(../images/panel_menu_active.png) no-repeat;
    padding-top: 8px;
    height: 27px;
    font: bold 15px Arial;
    color: #06264c;
}

.panel_menu li a.logout {
    width: 100px;
    background: url(../images/logout.png) no-repeat;
    background-position: bottom;
}

.panel_box .panel_table th {
    height: 43px;
    background: url(../images/th_bg.png) repeat-x;
    color: #fff;
}

.panel_box .panel_table {
    border-right: 1px solid #e5e5e5;
}

.panel_box .panel_table td {
    text-align: center;
    padding: 10px;
    border-left: 1px solid #e5e5e5;
    border-bottom: 1px solid #e5e5e5;
}

.box_form {
    border: 1px solid #cfd4d8;
    padding: 20px;
    
    overflow: hidden;
    clear: both;
    background: #eff0f4;
}

#formAddComapny .box_form {
    padding-left: 100px;
}

.box_form table th {
    text-align: left;
    font: 15px Arial;
}

.box_form input[type="text"], .box_form input[type="password"], .box_form select {
    border: 1px solid  #e4e8eb;
    font: 14px Arial;
    color: #1c385f;
    padding: 5px;
    width: 350px;
}

.saveFormButton {
    border: 0;
    width: 87px;
    height: 28px;
    background: url(../images/save.png) no-repeat;
    cursor: pointer;    
    float: right;
}

.saveFormButton2 {
    border: 0;
    width: 103px;
    height: 28px;
    background: url(../images/add_logo.png) no-repeat;
    cursor: pointer;    
    float: right;
}


.deleteCompany {
    color: #d30804;
    font: 20px Arial;
}

.deleteCompanyText {
    font: 12px Arial;
    width: 400px;
    min-width: 400px;
    max-width: 400px;
    margin: 10px auto;
}

.checkbox_list li {
    list-style: none;
}

/* panel : stop */

#company_categories_list {
    display: none;
}

.addCategory {
    display: block;
    width: 249px;
    height: 25px;
    background: url(../images/button.png) no-repeat;
    text-decoration: none;
    text-align: center;
    font: bold 14px Arial;
    color: #fff;
    padding-top: 8px;
}

#addCategoryBox {
    text-align: center;
}

.loadingAddCategory {
    margin-top: 140px;
}

#addCategories, #addCategories2, #addCategories3 {
    width: 200px;
    height: 400px;
}

#lastCategory, #treeCategory {
    display: none;
}

#selectedCategory {
    font-weight: bold;
    margin-bottom: 10px;
}

#selectedCategory a {
    text-decoration: none;
    color: red;
    padding-left: 20px;
    font-size: 20px;
}

a img {
    border: 0;
}

.choosePacketForm th {
    text-align: center !important;
    color: #fff;
    background: #072348;
    padding: 4px;
}

.choosePacketForm .radio_list {
    width: 40px;
    list-style: none;
    margin-top: 0;
    padding-top: 0;
    margin-bottom: 0;
    padding-bottom: 0;
    line-height: 30px;
}

.choosePacketForm  td {
    padding: 8px;
    text-align: center;
    font: bold 13px Arial;
    color: #153156;
}

.addCompanyButton {
    width: 249px;
    height: 33px;
    background: url(../images/button.png) no-repeat;
    text-decoration: none;
    text-align: center;
    font: bold 14px Arial;
    color: #fff;
    border: 0;
    cursor: pointer;
}

.button {
    width: 249px;
    height: 25px;
    background: url(../images/button.png) no-repeat;
    text-decoration: none;
    text-align: center;
    font: bold 14px Arial;
    padding-top: 8px;
    color: #fff;
    border: 0;
    cursor: pointer;
    display: block;
    min-width: 249px;
    max-width: 249px;
    margin: 10px auto;
}

.payable_box {
    text-align: center;
}

.pay_platnosci, .payable_button {
    background: url(../images/payable.png) no-repeat;
    border: 0;
    width: 259px;
    height: 51px;
    color: #032549;
    font: bold 17px Arial;
    cursor: pointer;
    text-align: center;
}

.payable_button {
    display: block;
    min-width: 259px;
    max-width: 259px;
    margin: 0 auto;
    text-decoration: none;
    padding-top: 16px;
    height: 35px;
}

.name_packet {
    font: bold 26px Arial;
    color: #d41818;
}

.notice {
  color: #c39700;
  border: 2px solid #c39700;
  padding: 10px;
  margin-bottom: 10px;
  background: #fff2c4;
}

.error {
  color: red;
  border: 2px solid red;
  padding: 10px;
  margin-bottom: 10px;
  background: #ffc4c4;
}

.add_new_file {
    width: 249px;
    height: 25px;
    background: url(../images/button.png) no-repeat;
    text-decoration: none;
    text-align: center;
    font: bold 14px Arial;
    padding-top: 8px;
    color: #fff;
    border: 0;
    cursor: pointer;
    display: block;
    min-width: 249px;
    max-width: 249px;
    margin: 10px auto;
}

.deletePicture {
    background: url(../images/deletePicture.png) no-repeat;
    background-position: top center;
    padding-top: 25px;
    color: #012d48;
}

.subcateogry_box {
    background: #f6f8f9;
    border: 1px solid #dbe0e9;
    width: 680px;
    min-width: 680px;
    max-width: 680px;
    margin: 0 auto;
    clear: both;
    overflow: hidden;
    padding: 10px;
}

.subcateogry_box ul {
    margin: 0;
    padding: 0;
    overflow: hidden;
    float: left;
    width: 170px;
    
}

.subcateogry_box ul li {
    margin: 0;
    padding: 0;
    list-style: none;  
    width: 150px;
    background: url(../images/sub.png) no-repeat;
    background-position: left center;
    padding-left: 10px;
}

.subcateogry_box ul li a {
    text-decoration: none;
    color: #04264a;
}

.subcateogry_box ul li a.active {
    font-weight: bold;
    color: #1990ba;
}

.subcateogry_box ul li a:hover {
    text-decoration: underline;
}

.pagination {
    text-align: center;
    margin-bottom: 7px;
}

#types_box {
    background: #f6f8f9;
    border: 1px solid #dbe0e9;
    width: 680px;
    min-width: 680px;
    max-width: 680px;
    margin: 0 auto;
    clear: both;
    overflow: hidden;
    padding: 10px;
    position: relative;
}

.types_box2 {
    background: #ebeef1;
    border-left: 1px solid #dbe0e9;
    border-right: 1px solid #dbe0e9;
    border-bottom: 1px solid #dbe0e9;
    width: 700px;
    min-width: 700px;
    max-width: 700px;
    margin: 0 auto;
    clear: both;
    overflow: hidden;
    height: 10px;
    
    
}

#types_box span, .filters span {    
    font: bold 15px Arial;
    color: #1c3a5c;
}

#top .logout {
    position: absolute;
    right: 10px;
    font: bold 12px Arial;
    color: #1C3A5C;
    top: 5px;
}

.k {
    background: url('../images/k.png') no-repeat;
    text-align: left;
    height: 25px;
    padding-left: 8px;
    font: bold 15px Arial;
    color: #09324e;
    padding-top: 4px;
    width: 140px;
    float: left;
}

.k a {
    font: bold 13px Arial;
    padding-left: 12px;
    color: #09324e;
    text-decoration: none;
}

.k a:hover {
    text-decoration: underline;
}    

.error_link {
    width: 300px;
    min-width: 300px;
    max-width: 300px;
    margin: 0 auto;
    clear: both;
    overflow: hidden;
    margin-bottom: 20px;
}

.star {
    font-weight: bold;
    color: red;
}

ul.error_list{
  margin: 0px;
  padding: 0px;
  list-style: none;
  width: 310px;
}

.error_list li{
  background: #FBE3E4;
  border: 2px solid #DDD;
  border-color: #FBC2C4;
  color: #8A1F11;
  margin: 0px;
  padding: 0px;
  text-align: center;
}

.go_back {
    height: 28px;
    overflow: hidden;
    background: #fff;
    padding-left: 10px;    
}

.go_back a {
    color: #000;
    font-weight: bold;
}

.filters {
    height: 30px;
    background: url(../images/filters.png) repeat-x;
    width: 680px;
    min-width: 680px;
    max-width: 680px;
    margin: 0 auto;
    padding-left: 10px;
    padding-right: 10px;
    border: 1px solid #e7ebee;
    margin-bottom: 15px;
    padding-top: 7px;
    padding-bottom: 15px;
}

.filters_input {
    border: 0;
    background: url(../images/input_filters.png) no-repeat;
    width: 212px;
    padding-top: 9px;
    padding-bottom: 9px;
    padding-left: 6px;
    padding-right: 6px;
    font: 14px Arial;
    color: #7c93ad;
}

.logos {
    display: block;
    height: 80px;
    float: left;
    background-position: top;
}

.logos:hover {
    background-position: bottom;
}

.logo_1 {
    width: 135px;
    background-image: url(../images/logo_1.png);    
}
