<!DOCTYPE html>
<head>
<style type="text/css">
.rating {
  unicode-bidi: bidi-override;
  direction: rtl;
  text-align: center;
}
.rating > span {
  display: inline-block;
  position: relative;
  width: 1.1em;
  size: 100;
}
.rating > span:hover,
.rating > span:hover ~ span {
  color: transparent;
}
.rating > span:hover:before,
.rating > span:hover ~ span:before {
   content: "\2605";
   position: absolute;
   left: 0; 
   color: gold;
}
</style>
</head>

<body{ padding: 100px; } >  
<form action="student_home.php">
<div class="rating">
<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
<input type="submit" name="submit" value="Submit">  
</div>
</form>
</body>
<html>
</html>