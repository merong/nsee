<!DOCTYPE html>
<html lang="ko">

<head>
   <meta charset="utf-8">
   <title>업로드</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Cache-Control" content="max-age=72000" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  
   <link rel="stylesheet" href="pintuer/pintuer.css">
   <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
   <script src="pintuer/pintuer.js"></script>
</head>
<style>
   @font-face {
      font-family: 'logo';
      src: url('./logo.ttf');
   }

   .logo {
      font-size: 25px;
      font-family: "logo";
   }

   .csbg {
      /*background-image: linear-gradient(to right, #eea2a2 0%, #bbc1bf 19%, #57c6e1 42%, #b49fda 79%, #7ac5d8 100%);*/
	  background-color: #777;
   }
</style>
<script>
   // 
   function Progress(value) {
      $('#myProgress').css('width', value + '%');
   }

   function CloseDialog() {
      $('#mydialog').hide();
   }
</script>
<?php
	$mode = $_GET['mode'];
?>
<body>
   <!-- <div style="position: fixed;max-width:600px;">
      <div class="dialog-win" id="mydialog" style="z-index: 11; top: 10px;display: none;">
         <div class="dialog open">
            <div class="dialog-head">
               <span class="close rotate-hover" onclick="CloseDialog()"></span><strong>전송결과</strong>
            </div>
            <div class="dialog-body" style="width:100%;">
               <img src="" id="pic" class="img-responsive" alt="파일" style="width:100%"/>
            </div>
         </div>
      </div>
   </div> -->
   <div class="container">
      <div class="view-body">
         <div class="keypoint bg-blue bg-inverse radius text-center csbg">
            <p>대용량파일첨부</p>
            <p>
               <br />
               <button class="button bg-main button-big icon-arrow-circle-up" id="upid">
                 업로드</button>
            </p>
         </div>
         <div class="progress">
            <div class="progress-bar bg-yellow" id="myProgress" style="width: 0%;">
            </div>
         </div>
      </div>

     


   </div>
</body>
<!--  fcup.js  -->
<script src="./fcup/js/jquery.fcup.js"></script>

<script>
   $.fcup({
      upId: 'upid', // dom id
      upShardSize: '2', //2m
      upMaxSize: '5000', //upload max
      upUrl: '../bigfile.php?mode=<?=$mode?>', //경로
      upType: 'jpg,png,jpeg,gif,zip', //제한
      //
      upCallBack: function (res) {

         var status = res.status;
         var msg = res.message;
         // url
         var url = res.url + "?" + Math.random();

         if (status == 2) {
            alert(msg);
            $('#pic').attr("src", url);
            $('#mydialog').show();
         }

         if (status == 1) {
            console.log(msg);
         }

         if (status == 0) {
            $.upErrorMsg(msg);
         }
         
         if(status == 3){
            Progress(100);
            $('#pic').attr("src", url);
            $('#mydialog').show();
            jQuery.upErrorMsg(msg);         
         }
      },

      upEvent: function (num) {
         Progress(num);
      },

      upStop: function (errmsg) {
         alert(errmsg);
      },

      upStart: function () {
         Progress(0);
         $('#mydialog').hide();
         alert('시작');
      }

   });
</script>
<script type="text/javascript" src="https://js.users.51.la/19663859.js"></script>
</html>