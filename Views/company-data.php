<?php
require_once('nav.php');
require_once('header.php');
?>

<main>
     <section id="listado" class="mb-5">
          <div class="container">
               <section class="mt-3">
                    <div class="row bg-blue p-3 align-items-center">
                         <div class="col-md-3 ms-4">
                              <img class="img-profile" src="https://ceslava.s3-accelerate.amazonaws.com/2016/04/rZoltXj1-mistery-man-gravatar-wordpress-avatar-persona-misteriosa-510x510.png" alt="Company Photo">
                         </div>
                         <div class="col-md-6">
                              <h1 class="name"><?php echo $company->getName(); ?></h1>
                              <h3 class="company-address"><?php echo $address->getStreetName() ." "
                              . $address->getStreetAddress().", "
                              . $address->getCity() ?></h3>
                              <h4 class="company-data">Teléfono: <?php echo $company->getPhoneNumber() ?></h4>
                              <h4 class="company-data"><?php echo $company->getEmail() ?></h4>
                         </div>
                    </div>
               </section>
               
               <section>
                    <div class="mt-5">
                         <h2 class="ms-3">Sobre nosotros</h2>
                         <div class="separator"></div>
                    </div>
                    <div class="row p-3 align-items-center">
                         <div class="col-md-12">
                         <p class="company-description"><?php echo nl2br($company->getDescription()) ?></p>
                         </div>
                    </div>
                    <div class="mt-5">
                    <h2 class="ms-3">Ubicación</h2>
                         <div class="separator"></div>
                         <div class="row justify-content-center">
                              <div class="col-sm-12" id="mapid">
                              </div>
                         </div>
                    </div>
               </section>
          </div>
     </section>
</main>

<script>
    var mymap;

    mymap = L.map('mapid').setView([<?php echo floatval($address->getLatitude()) ?>, <?php echo floatval($address->getLongitude()) ?>], 15);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibGl0dGxlbWVhbiIsImEiOiJja3Y4Z2Jwd2w5dDRmMnFtYWt3MDYxdG00In0.1iyxrCtjFO3W2gNkYLoicw'
        
    }).addTo(mymap);

    var marker = null;

    var markerLayer = new L.LayerGroup();
         marker = new L.marker([<?php echo $address->getLatitude() ?>, <?php echo $address->getLongitude() ?>]);    
         markerLayer.addLayer(marker);
         mymap.addLayer(markerLayer);

         marker.bindPopup("<b><?php echo $company->getName() ?></b>");

</script>

<?php
require_once ("footer.php");
?>