<?php
require_once('verify-login.php');
require_once('nav.php');
require_once('header.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="row">
               <div class="col">
               <h2 class="mb-4"><?php echo $company->getName() ?></h2>
               <table class="table bg-light-alpha">
                    <tbody>
                         <tr>
                              <th>Sobre nosotros</th>
                              <td><?php echo $company->getDescription() ?></td>
                         </tr>
                         <tr>
                              <th>Dirección</th>
                              <td><?php echo $address->getStreetName() ." ". $address->getStreetAddress().", ". $address->getCity() ?></td>
                         </tr>
                    </tbody>
               </table>
               </div>
               </div>
               <div class="row justify-content-center">
               <div class="col-lg-1"><label>Ubicación</label></div>
               </div>
               <div class="row justify-content-center">
               <div class="col-sm-12" id="mapid"></div>
          </div>
          <div>

          </div>
     </section>
</main>

<script>
    var mymap;

    mymap = L.map('mapid').setView([<?php echo $address->getLatitude() ?>, <?php echo $address->getLongitude() ?>], 15);

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
