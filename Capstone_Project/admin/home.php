<!DOCTYPE html>
<?php
	require_once 'logincheck.php';
	
	$username = "root";
	$password = "";
	$database = "capstonedbdraft";
	
	try {
	  $pdo = new PDO("mysql:host=localhost;database=$database", $username, $password);
	  // Set the PDO error mode to exception
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
	  die("ERROR: Could not connect. " . $e->getMessage());
	}

	$conn = new mysqli("localhost", "root", "", "capstonedbdraft") or die(mysqli_error());
?>
<html lang = "eng">
	<head>
		<title>LAFUENTE MEDICAL CLINIC Patient Record Management And Information System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "shortcut icon" href = "../images/logo.png" />
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css" />      
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/customize.css" />
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
		<?php require 'script.php'?>
        
	
</script>
		
	</head>
<body>
	<div class = "navbar navbar-default navbar-fixed-top">
		<img src = "../images/logo.png" style = "float:left;" height = "55px" /><label class = "navbar-brand">LAFUENTE MEDICAL CLINIC Patient Record Management Information System - Padre Burgos</label>
		<?php 
			$q = $conn->query("SELECT * FROM `admin` WHERE `admin_id` = $_SESSION[admin_id]") or die(mysqli_error());
			$f = $q->fetch_array();
		?>
			<ul class = "nav navbar-right">	
				<li class = "dropdown">
					<a class = "user dropdown-toggle" data-toggle = "dropdown" href = "#">
						<span class = "glyphicon glyphicon-user"></span>
						<?php 
							echo $f['firstname']." ".$f['lastname'];
						?>
						<b class = "caret"></b>
					</a>
				<ul class = "dropdown-menu">
					<li>
						<a class = "me" href = "logout.php"><i class = "glyphicon glyphicon-log-out"></i> Logout</a>
					</li>
				</ul>
				</li>
			</ul>
	</div>
	<div id = "sidebar">
			<?php include "sidemenu.php"; ?>
	</div>

	<?php 
// Attempt select query execution
try{
  $sql = "SELECT * FROM capstonedbdraftv2.sales";   
  $result = $pdo->query($sql);
  if($result->rowCount() > 0) {
    $sales = array();
    $create_at = array();
    while($row = $result->fetch()) {
      
      $sales[] = $row["sales"];
      $create_at[] = $row["create_at"];


    }
  unset($result);
  } else {
    echo "No records matching your query were found.";
  }
} catch(PDOException $e){
  die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}


try{
    $sql2 = "SELECT * FROM capstonedbdraft.sample_table ";   
    $result2 = $pdo->query($sql2);
    if($result2->rowCount() > 0) {
        $Cabuyao_Norte = array();
        $Cabuyao_Sur = array();
        $Danlagan = array();
      while($row = $result2->fetch()) {
        $Cabuyao_Norte[] = $row["Cabuyao_Norte"];
        $Cabuyao_Sur[] = $row["Cabuyao_Sur"];
        $Danlagan[] = $row["Danlagan"];

  
  
      }
    unset($result2);
    } else {
      echo "No records matching your query were found.";
    }
  } catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
  }
 
// Close connection
unset($pdo);
//print_r($create_at)
?>





<div id="content">
    <br />
    <br />

    <br />
    <div class="well" style="width: 50%">
        <input type="date" onchange="startDateFilter(this)">
        <input type="date" onchange="endDateFilter(this)">
        <div id="chartContainer" style="width: 100%; height: 400px">
            <canvas id="myChart"></canvas>
        </div>
        <div class="buttonBox">
          <button onclick="showData(5)">show 5 data data</button>
          <button onclick="showData(10)">show 10 data data</button>
          <button onclick="resetData()">reset</button>
        </div>
    </div>
    <div class="well" style="width: 50%">
        <div id="chartContainer2" style="width: 100%; height: 400px">
            <canvas id="myChart2"></canvas>
        </div>
    </div>
    <div class="well" style="width: 50%">
        <div id="chartContainer3" style="width: 100%; height: 400px">
            <canvas id="myChart3"></canvas>
        </div>
    </div>

</div>












	<script>





 






//setup block

const sales = <?php echo json_encode($sales);  ?>;
const create_at = <?php echo json_encode($create_at);  ?>;
//console.log(create_at)

const dateChartJS = create_at.map((day, index) => {
    let dayjs = new Date(day); 

    return dayjs.setHours(0,0,0,0)
})
console.log(dateChartJS) 

//setup
const data = {
labels: dateChartJS,
      datasets: [{
            label: '# of sales',
            data: <?php echo json_encode($sales);  ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',

            borderWidth: 1

          }
        
        
        ]

        };
        


        //config block
		const config = {
    type: 'line',
    data,
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Display 1', // Your label for Display 1
                font: {
                    size: 18
                }
            }
        },
        scales: {
            x: {
                min: '',
                max: '',
                type: 'time',
                time: {
                    unit: 'day'
                }
            },
            y: {
                beginAtZero: true
            }
        }
    }
};

          
//render Block

const myChart = new Chart (
  document.getElementById('myChart'),
  config
);


function startDateFilter(date){
    const startDate = new Date(date.value);
    console.log(startDate.setHours(0,0,0,0));
    myChart.config.options.scales.x.min = startDate.setHours(0,0,0,0);
    myChart.update();
}

function endDateFilter(date){
    const endDate = new Date(date.value);
    console.log(endDate.setHours(0,0,0,0));
    myChart.config.options.scales.x.max = endDate.setHours(0,0,0,0);
    myChart.update();
}

function showData(num){
   const salesSliced = sales.slice(0, num);
   const create_atSliced = create_at.slice(0, num);
   myChart.data.datasets[0].data = salesSliced;
   myChart.data.labels = create_atSliced;
   myChart.update();
};

function resetData(num){    
   myChart.data.datasets[0].data = sales;
   myChart.data.labels = create_at;
   myChart.update();
};


/* 
// Setup block for second set of data
const labels1 = ['a', 'b', 'c'];
const data2 = {
    labels: labels1,
    datasets: [{
        label: '# of sales',
        data: sales,
        backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',                
                'rgba(75, 192, 192, 0.2)',
            ],
        borderColor: 'rgb(60, 60, 60)',
        borderWidth: 1
    }]
};

// Config block for second chart
const config2 = {
    type: 'bar',
    data: data2,
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Display 2', // Your label for Display 2
                font: {
                    size: 18
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

// Render second chart
const myChart1 = new Chart(
    document.getElementById('myChart1'),
    config2
);

const Cabuyao_Norte = <?php echo json_encode($Cabuyao_Norte);  ?>;
const Cabuyao_Sur = <?php echo json_encode($Cabuyao_Sur);  ?>;
const Danlagan = <?php echo json_encode($Danlagan);  ?>;
*/


const data2 = {
    labels: [
    'Cabuyao Norte',
    'Cabuyao Sur',
    'Danlagan',
    'Duhat',
    'Hinguiwin',
    'Kinagunan Ibaba',
    'Kinagunan Ilaya',
    'Lipata',
    'Marao',
    'Marquez',
    'Burgos (Pob.)',
    'Campo (Pob.)',
    'Basiao (Pob.)',
    'Punta (Pob.)',
    'Rizal',
    'San Isidro',
    'San Vicente',
    'Sipa',
    'Tulay Buhangin',
    'Villapaz',
    'Walay',
    'Yawe'
  ],
  datasets: [
    {
      label: 'Patient per Baranggay in Padre Burgos',
      data: [15, 8, 32, 98, 49, 97, 31, 74, 38, 89, 61, 68, 40, 58, 5, 3, 12, 77, 91, 17, 91, 10],
      backgroundColor: 'rgb(255, 99, 132)',
      hoverOffset: 4
    },
    {
      label: 'Patient per Baranggay in Padre Burgos last year',
      data: [57, 61, 55, 29, 32, 44, 13, 98, 92, 64, 91, 32, 1, 15, 73, 56, 98, 99, 40, 80, 42, 2],
      backgroundColor: 'rgb(255, 99, 2)',
      hoverOffset: 4
    },
  ]
};

const config2 = {
  type: 'bar',
  data: data2,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
};

// Render second chart
const myChart2 = new Chart(document.getElementById('myChart2'), config2);



/*

///////////////////////

const labels = Utils.months({count: 7});
const data2 = {
  labels: labels,
  datasets: [{
    label: 'My First Dataset',
    data: [65, 59, 80, 81, 56, 55, 40],
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};

const config2 = {
  type: 'bar',
  data: data2,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
};
// Render second chart
const myChart2 = new Chart(
    document.getElementById('myChart2'),
    config2
);





*/




const data3 = {
    labels: [
    'CBC With Platelet Count / CBC',
    'Clotting Time',
    'BLEEDING TIME',
    'HBA1C',
    'FBS/RBS',
    'LIPID PROFIlE',
    'TOTAL CHOLESTEROL',
    'TRIGLYCERIDES',
    'BLOOD UREA NITROGEN',
    'CREATININE',
    'BLOOD URIC ACID',
    'SGPT / ALT',
    'SGOT / AST',
    'Punta (Pob.)',
    'ALBUMIN',
    'SODIUM',
    'POTASSIUM',
    'HBSAG',
    'VDRL',
    'URINALYSIS',
    'PREGNANCY',
    'FECALYSIS'
  ],
  datasets: [
    {
      label: 'Total of lab Test request',
      data: [46, 20, 42, 44, 21, 35, 25, 35, 34, 21, 20, 48, 25, 32, 22, 27, 32, 36, 37, 48, 45, 46],
      backgroundColor: 'rgba(245, 0, 0, 1)',
      hoverOffset: 4
    }
  ]
};


const config3 = {
  type: 'bar',
  data: data3,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
};

// Render second chart
const myChart3 = new Chart(document.getElementById('myChart3'), 
config3);


</script>



	<div id = "footer">
		<label class = "footer-title"></label>
	</div>
		
</body>
</html>



