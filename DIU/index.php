<?php include 'header.php'; ?>
<section>
		<h1 class="section-header">¡Bienvenidos a G-Tech!<hr></hr></h1>
		<article><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis sagittis interdum. Pellentesque eleifend in nunc eget elementum. Ut efficitur dictum purus, ut suscipit lectus consequat a. Nunc ut risus venenatis, bibendum tortor ut, imperdiet dui. Ut consectetur diam nec leo viverra, vitae consectetur velit cursus. Phasellus eget ligula mattis, semper justo eu, venenatis enim.</p>

    <p>Quisque a lorem augue. Praesent luctus fringilla quam. Mauris in urna nisl. Cras elementum mi lacinia odio sodales, placerat ornare sapien pellentesque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc est arcu, efficitur molestie porttitor dictum, elementum vitae nunc. In leo magna, vestibulum pharetra sem nec, efficitur mattis arcu. Nulla dictum mauris eu neque porttitor fringilla. Ut et ligula erat. Fusce faucibus lorem non mauris efficitur auctor.</p>
			
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="assets/img/carousel1.jpg" alt="Coworking">
    </div>

    <div class="item">
      <img src="assets/img/carousel2.jpg" alt="Coworking">
    </div>

    <div class="item">
      <img src="assets/img/carousel3.jpg" alt="Coworking">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<h2>Contacto</h2>
<address>Dirección: C/ Nueva, 654</address>
<small>Tfno.: 958664422</small><br>
<small>Fax: 958664422</small>

</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("inicio").className = "active menu";
}
</script>
<?php include 'footer.php'; ?>