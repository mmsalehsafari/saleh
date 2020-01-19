<? require_once('main.php');?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="tooltipster.main.min.css">
  <link rel="stylesheet" href="base.css">
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="tooltipster.bundle.min.js"></script>
    <title>Ajax Test</title>
</head>
<body>
<div id="header-wrapper">

</div>

<div id="content" class="ltr">
  <ul class="cols">
  <li class="w50"><input style="width: 300px;" class="tooltip" title="search"  id="search"   placeholder="Type Keyword Here" value="" autocomplete="off"></li>
  <li class="w50"><div id="preview"></div></li>
  </ul>
</div>

</body>
</html>
<script>
  $(function(){
    $('.tooltip').tooltipster({
      contentAsHTML: true,
      animation: 'fade',
      position: 'bottom',
      interactive: true

    });
   $('#search').on('keyup',function(){
    var value = $(this).val();
     $.ajax('feed.php',{
       type: 'post',
       dataType: 'json',
       data: {
         keyword:value,
         fullname:'test'
       },
       success: function(data){
         /*
         $('#preview').html(data.html);
         */
         var records = data.raw;
         var html = '';
         for (var i in records){
           var record = records[i];
           var meaning = record.meaning || 'no meaning';
           var url = "https://translate.google.com/#view=home&op=translate&sl=en&tl=fa&text=" + record.word;
           html += '<strong><a target="_blank" href="' + url + '">' + record.word + '</a></strong><br><span>' + meaning + '</span><br><br><hr>';
         }
         var previewHtml = '<div class = "ltr preview-word">' + html + '</div>';
         var tooltipsterHtml ='<div class="ltr tooltipster-word" style="width: 300px" >' + html + '</div>';
         $('#preview').html(previewHtml);
         $('#search').tooltipster('content' , tooltipsterHtml );
     }
     })
      });
  });






</script>