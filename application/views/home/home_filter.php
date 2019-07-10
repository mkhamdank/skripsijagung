<!DOCTYPE html>
<html lang="en">
<head>
<title>Pengelompokan Tanaman Jagung Jatim</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/uniform.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/select2.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/maruti-style.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/maruti-media.css" class="skin-color" />
</head>
<body>

<!--Header-part-->
<div id="header">
  <h2><a href="<?php echo site_url('Home') ?>">Pengelompokan Tanaman Jagung Jawa Timur</a></h2>
</div>
<?php
        foreach($jagung as $data){
            $tahun[] = $data->tahun;
            $produksi[] = (float) $data->produksi;
            $produktivitas[] = (float) $data->produktivitas;
            $luas_panen[] = (float) $data->luas_panen;
            $nama_lokasi = $data->nama_lokasi;
        }
?>
<!--close-Header-part--> 

<!--top-Header-messaages-->
<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
<!--close-top-Header-messaages--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class=""><a title="" href="<?php echo site_url('Login') ?>"><i class="icon icon-share-alt"></i> <span class="text">Login</span></a></li>
    <li class=""><a title="" href="<?php echo site_url('Login/register') ?>"><i class="icon icon-align-justify"></i> <span class="text">Register</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->

<div id="sidebar">
  <ul>
  </ul>
</div>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo site_url('Home') ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    <h3>Grafik Data Tanaman Jagung Di <?php echo $nama_lokasi ?></h3>
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Filter Grafik</h5>
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <div class="widget-content nopadding">
              <?php echo form_open('Home/filter_grafik',array(
                      'class' => 'form-horizontal'
                  )); ?>
                <div class="control-group">
                  <label class="control-label">Lokasi :</label>
                  <div class="controls">
                    <select name="lokasi" id="inputTahun" class="span11" required="required">
                      <?php foreach ($lokasi as $key) { ?>
                          <option value="<?php echo $key->id_lokasi ?>"><?php echo $key->nama_lokasi ?></option>
                      <?php } ?>
                    </select>
                    <input type="hidden" name="hidden"class="form-control" value="Tahun">
                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-success">Filter</button>
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
   
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Grafik Data Produktivitas (Ku/Ha) di <?php echo $nama_lokasi ?></h5>
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <div class="container-fluid">
              <canvas id="canvas" width="1250" height="280"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Grafik Data Produksi (Ton) di <?php echo $nama_lokasi ?></h5>
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <!-- <div class="span"> -->
              <canvas id="canvas2" width="1250" height="280"></canvas>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>

    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Grafik Data Luas Lahan (Ha) di <?php echo $nama_lokasi ?></h5>
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <!-- <div class="span"> -->
              <canvas id="canvas3" width="1250" height="280"></canvas>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>
</div>
<div class="row-fluid">
  <div id="footer" class="span12"> 2019 &copy; Mokhamad Khamdan Khabibi</div>
</div>
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/excanvas.min.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/jquery.min.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/jquery.ui.custom.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/jquery.uniform.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/select2.min.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/maruti.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/maruti.tables.js"></script>
 

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
<script type="text/javascript" src="<?php echo base_url().'assets/chartjs/chart.min.js'?>"></script>
    <script>
 
            var lineChartData = {
                labels : <?php echo json_encode($tahun);?>,
                datasets : [
                     
                    {
                        fillColor: "#49cced",
                        strokeColor: "#2e363f",
                        pointColor: "#2e363f",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#49cced",
                        data : <?php echo json_encode($produktivitas);?>
                    }
 
                ]
                 
            }
 
        var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
    </script>
    <script>
 
            var lineChartData = {
                labels : <?php echo json_encode($tahun);?>,
                datasets : [
                     
                    {
                        fillColor: "#49cced",
                        strokeColor: "#2e363f",
                        pointColor: "#2e363f",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#49cced",
                        data : <?php echo json_encode($produksi);?>
                    }
 
                ]
                 
            }
 
        var myLine = new Chart(document.getElementById("canvas2").getContext("2d")).Line(lineChartData);
    </script>
    <script>
 
            var lineChartData = {
                labels : <?php echo json_encode($tahun);?>,
                datasets : [
                     
                    {
                        fillColor: "#49cced",
                        strokeColor: "#2e363f",
                        pointColor: "#2e363f",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#49cced",
                        data : <?php echo json_encode($luas_panen);?>
                    }
 
                ]
                 
            }
 
        var myLine = new Chart(document.getElementById("canvas3").getContext("2d")).Line(lineChartData);
    </script>
</body>
</html>
