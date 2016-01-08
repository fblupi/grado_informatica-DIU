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
			<img class="carrousel" src="assets/img/carousel1.jpg" alt="Imagen Coworking 1">
    </div>

    <div class="item">
      <img class="carrousel" src="assets/img/carousel2.jpg" alt="Imagen Coworking 2">
    </div>

    <div class="item">
      <img class="carrousel" src="assets/img/carousel3.jpg" alt="Imagen Coworking 3">
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

<div class="row">
  <div class="col-md-6 col-lg-6">
    <p class="elementoContacto"><i class="fa fa-1x fa-home etiquetasContacto"></i>C/ Periodista Daniel Saucedo Aranda, s/n, 18071 (Granada)</p>
    <p class="elementoContacto"><i class="fa fa-1x fa-phone etiquetasContacto"></i>958664422</p>
    <p class="elementoContacto"><i class="fa fa-1x fa-fax etiquetasContacto"></i>958664422</p>
  </div>
  <div class="col-md-6 col-lg-6">
    <iframe class="mapaContacto" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3178.1369913180424!2d-3.624257999999999!3d37.19697549999999!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x4dbbca09efdcad08!2sE.T.S.+de+Ingenier%C3%ADas+Inform%C3%A1tica+y+de+Telecomunicaci%C3%B3n!5e0!3m2!1ses!2ses!4v1426164292339"></iframe>
  </div>
</div>

</article>
</section>
<script type="text/javascript">
window.onload = function()
{
	document.getElementById("inicio").className = "active menu";
	document.getElementById("logos").className = "animated rubberBand";
}
</script>
<?php include 'footer.php'; ?>
