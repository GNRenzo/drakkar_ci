<?php
require_once("/var/www/html/JavaBridge/java/Java.inc");
require_once APPPATH . 'libraries/vendor/autoload.php';
use Aws\S3\S3Client;  
use Aws\Exception\AwsException;


class Jaspergen extends MY_Controller{

	public function __construct(){
		parent::__construct();
		//$this->load->model('area_model');
	}

	public function conexionJDBC(){
		$objClass = new JavaClass("java.lang.Class");
		$objClass->forName('org.postgresql.Driver');
		$objDbm = new Java("java.sql.DriverManager");
		$objDbConnect = $objDbm->getConnection("jdbc:postgresql://agvpgsql.cd0jfjeqc6yz.us-east-1.rds.amazonaws.com:5432/agvbi", "dms_superuser", '&%$rUuD/&v4N#*N15st3lr00y_-[');
		return $objDbConnect;
	}

	public function conexionJDBCdbware(){
		$objClass = new JavaClass("java.lang.Class");
		$objClass->forName('org.postgresql.Driver');
		$objDbm = new Java("java.sql.DriverManager");
		$objDbConnect = $objDbm->getConnection("jdbc:postgresql://agvpgsql.cd0jfjeqc6yz.us-east-1.rds.amazonaws.com:5432/dbware", "dms_superuser", '&%$rUuD/&v4N#*N15st3lr00y_-[');
		return $objDbConnect;
	}

	/*public function conexionJDBC_agrosmart_qas(){
		$objClass = new JavaClass("java.lang.Class");
		$objClass->forName('org.postgresql.Driver');
		$objDbm = new Java("java.sql.DriverManager");
		$objDbConnect = $objDbm->getConnection("jdbc:postgresql://agvpgsql.cd0jfjeqc6yz.us-east-1.rds.amazonaws.com:5432/agrosmart_qas", "agrovisioncorp", "agr0v1s10N_b1_rds.aw5");
		return $objDbConnect;
	}*/
	
	public function conexionJDBC_agrosmart_qas(){
		$objClass = new JavaClass("java.lang.Class");
		$objClass->forName('org.postgresql.Driver');
		$objDbm = new Java("java.sql.DriverManager");
		$objDbConnect = $objDbm->getConnection("jdbc:postgresql://agvpgsql.cd0jfjeqc6yz.us-east-1.rds.amazonaws.com:5432/smartagro_prd", "dms_superuser", '&%$rUuD/&v4N#*N15st3lr00y_-[');
		return $objDbConnect;
	}





	public function genExcelJasperTest(){

		try {

			// echo "try -";

			$rutaInforme = BASEPATH."../project/reportes_jasper/reporttest.jasper";

			$path =BASEPATH."../project/reportes_jasper/reporttest.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			// echo "clsssss -";




			$informe = $sJfm->fillReport($rutaInforme,null,$this->conexionJDBC());

			// echo " - JFILLMANAGER - ";

			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT, $informe);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());


			//EXPORTA EL REPORTE XLSX EN EL SERVIDOR
			$exporter->exportReport();

			//********************DESCARGA EL ARCHIVO EXPORTADO DEL SERVIDOR EN DESCARGAS DEL CLIENTE LOCAL

			$fileD = BASEPATH.'../project/reportes_jasper/reporttest.xlsx';
			header("Content-Disposition: attachment; filename=$fileD");
			header('Content-Disposition: filename="reporttest.xlsx"');
			header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

			readfile($fileD);

			////*******************************

			// echo " REPORTE EXPORTADO! -";

		} catch (JavaException $ex) {
			// echo "CATCH";
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}



	public function exportExcelJasperInventarioProcesos(){

		$seccion=$_POST['cboMacroseccion'];
		$macroproceso=$_POST['cboMacroproceso'];


		try {

			// echo "try -";

			$rutaInforme = BASEPATH."../project/reportes_jasper/inventarioProcesos.jasper";

			$path ="/var/lib/tomcat9/webapps/inventarioProcesos.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			// echo "clsssss -";

			$params = new Java("java.util.HashMap");

			$nombre_parametro1 = "seccion";
			$nombre_parametro2 = "macroproceso";

			$vp1 =  $seccion;
			$vp2 =  $macroproceso;

			$params->put($nombre_parametro1, $vp1);
			$params->put($nombre_parametro2, $vp2);



			$informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC());

			// echo " - JFILLMANAGER - ";

			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT, $informe);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());


			$exporter->exportReport();


			$fileD = '/var/lib/tomcat9/webapps/inventarioProcesos.xlsx';
			header("Content-Disposition: attachment; filename=$fileD");
			header('Content-Disposition: filename="Reporte_Inventario_Procesos_DMS.xlsx"');
			header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

			readfile($fileD);

		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}


	public function exportExcelAreasSecciones(){

		$departamento_codigo=$_POST['cboDepartamento'];
		$area_codigo=$_POST['cboArea'];


		try {
			$rutaInforme = BASEPATH."../project/reportes_jasper/areasSecciones.jasper";

			$path ="/var/lib/tomcat9/webapps/areasSecciones.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			// echo "clsssss -";

			$params = new Java("java.util.HashMap");

			$nombre_parametro1 = "departamento_codigo";
			$nombre_parametro2 = "area_codigo";


			$vp1 =  $departamento_codigo;
			$vp2 =  $area_codigo;


			$params->put($nombre_parametro1, $vp1);
			$params->put($nombre_parametro2, $vp2);




			$informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC());

			// echo " - JFILLMANAGER - ";

			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT, $informe);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());


			//EXPORTA EL REPORTE XLSX EN EL SERVIDOR
			$exporter->exportReport();
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			// shell_exec('sudo chmod -R 777 /var/lib/tomcat9/webapps/areasSecciones.xlsx');

		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}



	public function downloadExcelJasperAreasSecciones(){
        $fileD = '/var/lib/tomcat9/webapps/areasSecciones.xlsx';

        header("Content-Disposition: attachment; filename=$fileD");
        header('Content-Disposition: filename="Reporte_Areas_Secciones.xlsx"');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

        readfile($fileD);
    }







	public function exportExcelEntregaEpp2(){


		$fechaFrom=$_POST['txtFechaFrom'];
		$fechaTo=$_POST['txtFechaTo'];
		$placa=$_POST['cboPlaca'];
		$dni=$_POST['cboDni'];




		try {
			$rutaInforme = BASEPATH."../project/reportes_jasper/entregaEpp.jasper";
            if($fechaFrom == "2022-06-01" && $fechaTo == "2022-06-01"){
                $rutaInforme = BASEPATH."../project/reportes_jasper/entregaEpp_01_06_22.jasper";
            }

			$path ="/var/lib/tomcat9/webapps/entregaEpp.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			// echo "clsssss -";

			$params = new Java("java.util.HashMap");

			$nombre_parametro1 = "from";
			$nombre_parametro2 = "to";
			$nombre_parametro3 = "placa";
			$nombre_parametro4 = "dni";

			$vp1 =  $fechaFrom;
			$vp2 =  $fechaTo;
			$vp3 =  $placa;
			$vp4 =  $dni;

			$params->put($nombre_parametro1, $vp1);
			$params->put($nombre_parametro2, $vp2);
			$params->put($nombre_parametro3, $vp3);
			$params->put($nombre_parametro4, $vp4);




			$informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBCdbware());

			// echo " - JFILLMANAGER - ";

			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT, $informe);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());


			//EXPORTA EL REPORTE XLSX EN EL SERVIDOR
			$exporter->exportReport();


			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);


		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}

	public function downloadExcelJasperEntregaEpp2(){

       // $fileD = '/var/lib/tomcat9/webapps/areasSecciones.xlsx';
		 $fileD = '/var/lib/tomcat9/webapps/entregaEpp.xlsx';
        // $fileD = str_replace(' ', '_', $fileD);
		 // chmod($fileD, 777);

        header("Content-Disposition: attachment; filename=$fileD");
        header('Content-Disposition: filename="Reporte_Entrega_Epp.xlsx"');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

        readfile($fileD);
    }

	public function exportExcelEntregaEpp(){


		$fechaFrom=$_POST['txtFechaFrom'];
		$fechaTo=$_POST['txtFechaTo'];
		//$placa=$_POST['cboPlaca'];
		$dni=$_POST['cboDni'];
		$listaPlacas = json_decode($_POST['cbolistaPlaca'],true);





		try {
			$rutaInforme = BASEPATH."../project/reportes_jasper/entregaEpp.jasper";

            if($fechaFrom == "2022-06-01" && $fechaTo == "2022-06-01"){
                $rutaInforme = BASEPATH."../project/reportes_jasper/entregaEpp_01_06_22.jasper";
            }

			$path ="/var/lib/tomcat9/webapps/entregaEpp.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			// echo "clsssss -";

			$params = new Java("java.util.HashMap");

			$nombre_parametro1 = "from";
			$nombre_parametro2 = "to";
			$nombre_parametro3 = "placa";
			$nombre_parametro4 = "dni";

			$vp1 =  $fechaFrom;
			$vp2 =  $fechaTo;

			$vp4 =  $dni;


			$params->put($nombre_parametro1, $vp1);
			$params->put($nombre_parametro2, $vp2);
			$params->put($nombre_parametro4, $vp4);


			$JasperPrint= new java("net.sf.jasperreports.engine.JasperPrint");
			$paramList = new Java("java.util.ArrayList");
			$paramName = new Java("java.util.ArrayList");


			$Array = new JavaClass("java.lang.reflect.Array");
			$sheetNames = $Array->newInstance(new JavaClass("java.lang.String"), array(count($listaPlacas)));
			for ($i=0; $i < count($listaPlacas) ; $i++) {
				$idPlaca = $listaPlacas[$i]["idplaca"];
				$vp3 =  $idPlaca;
				$params->put($nombre_parametro3, $vp3);
				$informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBCdbware());
				$paramList->add($informe);

				if($idPlaca == "0"){
					$idPlaca = "Todos";
				}
				$sheetNames[$i] = "Placa ".$idPlaca;

			}



			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT_LIST, $paramList);

			//$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->SHEET_NAMES,$paramName);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->SHEET_NAMES, $sheetNames);



			//EXPORTA EL REPORTE XLSX EN EL SERVIDOR
			$exporter->exportReport();


			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);


		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}
	public function downloadExcelJasperEntregaEpp(){

       // $fileD = '/var/lib/tomcat9/webapps/areasSecciones.xlsx';
		 $fileD = '/var/lib/tomcat9/webapps/entregaEpp.xlsx';
        // $fileD = str_replace(' ', '_', $fileD);
		 // chmod($fileD, 777);

        header("Content-Disposition: attachment; filename=$fileD");
        header('Content-Disposition: filename="Reporte_Entrega_Epp.xlsx"');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

        readfile($fileD);
    }




	public function exportExcelAuditoria(){

		$sucursal=  (int) $this->input->post('sucursal');;
		$seccion= $this->input->post('seccion');
		$macroproceso= $this->input->post('macroproceso');

		/*
		$Usuario = $this->session->userdata('USUARIO');
		$sucursal= $Usuario['sucursal'];
		$seccion= $this->input->post('seccion');
		$macroproceso= $this->input->post('macroproceso');
		$macroproceso= "000008";*/





		try {

			$rutaInforme = BASEPATH."../project/reportes_jasper/auditoria.jasper";
			$path ="/var/lib/tomcat9/webapps/auditoria.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			//echo "clsssss -";

			$params = new Java("java.util.HashMap");

			$nombre_parametro1 = "sucursal";
			$nombre_parametro2 = "seccion";
			$nombre_parametro3 = "macroproceso";

			$vp1 =  $sucursal;
			$vp2 =  $seccion;
			$vp3 =  $macroproceso;

			$params->put($nombre_parametro1, $vp1);
			$params->put($nombre_parametro2, $vp2);
			$params->put($nombre_parametro3, $vp3);



			$informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC());

			//$JasperPrint= new java("net.sf.jasperreports.engine.JasperPrint");
			//$arrayList = new java("java.util.ArrayList");
			//$listObj = new java("java.util.List");

			//$arrayList->$JasperPrint ;;

			//$workbook = new java("org.apache.poi.hssf.usermodel.HSSFWorkbook");
			//$sheet = $workbook->createSheet("new sheet");
			//$row = $sheet->$sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC());

			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT, $informe);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());

			//echo " - exporter 01 - ";

			//EXPORTA EL REPORTE XLSX EN EL SERVIDOR
			$exporter->exportReport();
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			echo "ok";

		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}

	public function downloadExcelJasperAuditoria(){

		$fileD = '/var/lib/tomcat9/webapps/auditoria.xlsx';

        header("Content-Disposition: attachment; filename=$fileD");
        header('Content-Disposition: filename="Reporte_Auditoria.xlsx"');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

        readfile($fileD);
    }

	public function exportExcelContratosFirmados(){

		$contratista =  (int) $this->input->post('cboContratista');;
		$tipo =  (int)$this->input->post('cboTipo');
		$area =  (int) $this->input->post('cboArea');


		try {

			$rutaInforme = BASEPATH."../project/reportes_jasper/contratosFirmados.jasper";
			$path ="/var/lib/tomcat9/webapps/contratosFirmados.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			//echo "clsssss -";

			$params = new Java("java.util.HashMap");

			$nombre_parametro1 = "contratista";
			$nombre_parametro2 = "tipo";
			$nombre_parametro3 = "area";

			$vp1 =  $contratista;
			$vp2 =  $tipo;
			$vp3 =  $area;

			$params->put($nombre_parametro1, $vp1);
			$params->put($nombre_parametro2, $vp2);
			$params->put($nombre_parametro3, $vp3);


			$informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC());


			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT, $informe);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());

			//echo " - exporter 01 - ";

			//EXPORTA EL REPORTE XLSX EN EL SERVIDOR
			$exporter->exportReport();
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			echo "ok";

		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}

	public function downloadExcelJasperContratosFirmados(){

		$fileD = '/var/lib/tomcat9/webapps/contratosFirmados.xlsx';

		header("Content-Disposition: attachment; filename=$fileD");
		header('Content-Disposition: filename="Reporte_Contratos_Firmados.xlsx"');
		header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

		readfile($fileD);
	}


	public function exportExcelVacaciones(){

		$Usuario = $this->session->userdata('USUARIO');
		$idRolNomina = $Usuario['idrol_nomina'];
		$cboPor =  $this->input->post('cboPor');
		$fecha_registro =  $this->input->post('fecha_registro');
		$fecha_inicio =  $this->input->post('fecha_inicio');
		$fecha_fin = $this->input->post('fecha_fin');
		$fecha_retorno = $this->input->post('fecha_retorno');
		$trabajador =  $this->input->post('trabajador');
		$estado =  $this->input->post('estado');
		$jefe = $this->input->post('jefe');



		/*
		$fecha_inicio = "2022-03-13";
		$fecha_fin = "2022-03-23";
		$trabajador = 0;
		$dni = "T";*/


		try {

			$rutaInforme = BASEPATH."../project/reportes_jasper/reporteVacaciones.jasper";
			$path ="/var/lib/tomcat9/webapps/reporteVacaciones.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			//echo "clsssss -";

			$params = new Java("java.util.HashMap");

			$nombre_parametro1 = "cboPor";
			$nombre_parametro2 = "fecha_registro";
			$nombre_parametro3 = "fecha_inicio";
			$nombre_parametro4 = "fecha_fin";
			$nombre_parametro5 = "trabajador";
			$nombre_parametro6 = "estado";
			$nombre_parametro7 = "jefe";
			$nombre_parametro8 = "fecha_retorno";
			$nombre_parametro9 = "id_nomina";

			$vp1 =  $cboPor;
			$vp2 =  $fecha_registro;
			$vp3 =  $fecha_inicio;
			$vp4 =  $fecha_fin;
			$vp5 =  $trabajador;
			$vp6 =  $estado;
			$vp7 =  $jefe;
			$vp8 =  $fecha_retorno;
			$vp9 =  $idRolNomina;

			$params->put($nombre_parametro1, $vp1);
			$params->put($nombre_parametro2, $vp2);
			$params->put($nombre_parametro3, $vp3);
			$params->put($nombre_parametro4, $vp4);
			$params->put($nombre_parametro5, $vp5);
			$params->put($nombre_parametro6, $vp6);
			$params->put($nombre_parametro7, $vp7);
			$params->put($nombre_parametro8, $vp8);
			$params->put($nombre_parametro9, $vp9);



			$informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC());


			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT, $informe);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());

			//echo " - exporter 01 - ";

			//EXPORTA EL REPORTE XLSX EN EL SERVIDOR
			$exporter->exportReport();
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			echo "ok";

		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}

	public function downloadExcelJasperVacaciones(){

		$fileD = '/var/lib/tomcat9/webapps/reporteVacaciones.xlsx';

		header("Content-Disposition: attachment; filename=$fileD");
		header('Content-Disposition: filename="Reporte_Vacaciones.xlsx"');
		header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

		readfile($fileD);
	}

	public function exportExcelEmpleadoPeriodoVacaciones(){
		///*
		$Usuario = $this->session->userdata('USUARIO');
		$idRolNomina = $Usuario['idrol_nomina'];

		$periodo=  $this->input->post('periodo');
		$trabajador =  $this->input->post('trabajador');
		$estado =  $this->input->post('estado');
		$jefe = $this->input->post('jefe');
		$cierre = $this->input->post('cboCierre');
        $JefeFil = $this->input->post('cboJefe') ?: 0;
        $Area = $this->input->post('cboArea')?: 0;

		try {

			$rutaInforme = BASEPATH."../project/reportes_jasper/reporteEmpPeriodoVacaciones.jasper";
			$path ="/var/lib/tomcat9/webapps/reporteEmpPeriodoVacaciones.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			//echo "clsssss -";

			$params = new Java("java.util.HashMap");

			$nombre_parametro1 = "periodo";
			$nombre_parametro2 = "trabajador";
			$nombre_parametro3 = "estado";
			$nombre_parametro4 = "jefe";
			$nombre_parametro5 = "id_nomina";
			$nombre_parametro6 = "cierre";
            $nombre_parametro7 = "jefefil";
            $nombre_parametro8 = "area";

			$vp1 =  $periodo;
			$vp2 =  $trabajador;
			$vp3 =  $estado;
			$vp4 =  $jefe;
			$vp5 =  $idRolNomina;
			$vp6 =  $cierre;
            $vp7 =  $JefeFil;
            $vp8 =  $Area;

			$params->put($nombre_parametro1, $vp1);
			$params->put($nombre_parametro2, $vp2);
			$params->put($nombre_parametro3, $vp3);
			$params->put($nombre_parametro4, $vp4);
			$params->put($nombre_parametro5, $vp5);
			$params->put($nombre_parametro6, $vp6);
            $params->put($nombre_parametro7, $vp7);
            $params->put($nombre_parametro8, $vp8);


			$informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC());


			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT, $informe);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());

			//echo " - exporter 01 - ";

			//EXPORTA EL REPORTE XLSX EN EL SERVIDOR
			$exporter->exportReport();
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			echo "ok";

		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}



	public function downloadExcelJasperEmpleadoPeriodoVacaciones(){

		$fileD = '/var/lib/tomcat9/webapps/reporteEmpPeriodoVacaciones.xlsx';

		header("Content-Disposition: attachment; filename=$fileD");
		header('Content-Disposition: filename="Reporte_Periodo_Vacaciones.xlsx"');
		header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

		readfile($fileD);
	}

	public function exportExcelProgramacionPendiente(){

		$Usuario = $this->session->userdata('USUARIO');
		$idRolNomina = $Usuario['idrol_nomina'];


		$periodo=  $this->input->post('periodo');
		$trabajador =  $this->input->post('trabajador');
		$estado =  $this->input->post('estado');
		$jefe = $this->input->post('jefe');
		$cierre = $this->input->post('cboCierre');
        $JefeFil = $this->input->post('cboJefe');
        $Area = $this->input->post('cboArea');



		/*$periodo = "0";
		$estado = "0";
		$trabajador = 0;
		$jefe = "42126912";*/



		try {

			$rutaInforme = BASEPATH."../project/reportes_jasper/reporteEmpProgramacionPendiente.jasper";
			$path ="/var/lib/tomcat9/webapps/reporteEmpProgramacionPendiente.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			//echo "clsssss -";

			$params = new Java("java.util.HashMap");

			$nombre_parametro1 = "periodo";
			$nombre_parametro2 = "trabajador";
			$nombre_parametro3 = "estado";
			$nombre_parametro4 = "jefe";
			$nombre_parametro5 = "id_nomina";
			$nombre_parametro6 = "cierre";
            $nombre_parametro7 = "jefefil";
            $nombre_parametro8 = "area";

			$vp1 =  $periodo;
			$vp2 =  $trabajador;
			$vp3 =  $estado;
			$vp4 =  $jefe;
			$vp5 =  $idRolNomina;
			$vp6 =  $cierre;
            $vp7 =  $JefeFil;
            $vp8 =  $Area;

			$params->put($nombre_parametro1, $vp1);
			$params->put($nombre_parametro2, $vp2);
			$params->put($nombre_parametro3, $vp3);
			$params->put($nombre_parametro4, $vp4);
			$params->put($nombre_parametro5, $vp5);
			$params->put($nombre_parametro6, $vp6);
            $params->put($nombre_parametro7, $vp7);
            $params->put($nombre_parametro8, $vp8);


			$informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC());


			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT, $informe);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());

			//echo " - exporter 01 - ";

			//EXPORTA EL REPORTE XLSX EN EL SERVIDOR
			$exporter->exportReport();
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			echo "ok";

		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}


	public function downloadExcelJasperProgramacionPendiente(){

		$fileD = '/var/lib/tomcat9/webapps/reporteEmpProgramacionPendiente.xlsx';

		header("Content-Disposition: attachment; filename=$fileD");
		header('Content-Disposition: filename="Reporte_Periodo_Programaciones_pendientes.xlsx"');
		header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

		readfile($fileD);
	}



	public function descargartesteandosheet (){

		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=downloaded.xls");

		$workbook = new java("org.apache.poi.hssf.usermodel.HSSFWorkbook");
		$sheet = $workbook->createSheet("new sheet");
		$sheet22 = $workbook->createSheet("new sheet22");

		for($y=0; $y<40; $y++) {
		  $row = $sheet->createRow($y);
		  for($x=0; $x<50; $x++) {
			$cell = $row->createCell($x);
			$cell->setCellValue("cell $x/$y");
		  }
		}

		for($y=0; $y<40; $y++) {
		  $row = $sheet22->createRow($y);
		  for($x=0; $x<50; $x++) {
			$cell = $row->createCell($x);
			$cell->setCellValue("cell $x/$y");
		  }
		}

		// create and return the excel sheet to the client
		$memoryStream = new java("java.io.ByteArrayOutputStream");
		$workbook->write($memoryStream);
		$memoryStream->close();
		echo java_values($memoryStream->toByteArray());
	}


	public function exportExcelAuditoriaTesteando(){

		$sucursal=1;
		$seccion= "T";
		$macroproceso= "000009";





		try {

			$rutaInforme = BASEPATH."../project/reportes_jasper/auditoria.jasper";
			$path ="/var/lib/tomcat9/webapps/auditoria_testeo.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			//echo "clsssss -";

			$params = new Java("java.util.HashMap");

			$nombre_parametro1 = "sucursal";
			$nombre_parametro2 = "seccion";
			$nombre_parametro3 = "macroproceso";

			$vp1 =  $sucursal;
			$vp2 =  $seccion;
			$vp3 =  $macroproceso;

			$params->put($nombre_parametro1, $vp1);
			$params->put($nombre_parametro2, $vp2);
			$params->put($nombre_parametro3, $vp3);




			$informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC());
			$informe2 = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC());


			$JasperPrint= new java("net.sf.jasperreports.engine.JasperPrint");
			$paramList = new Java("java.util.ArrayList");
			$paramList->add($informe);
			$paramList->add($informe2);


			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT_LIST, $paramList);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());

			//echo " - exporter 01 - ";

			//EXPORTA EL REPORTE XLSX EN EL SERVIDOR
			$exporter->exportReport();
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			//echo "ok";

		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}

		public function downloadExcelAuditoriaTesteando(){

		$fileD = '/var/lib/tomcat9/webapps/auditoria_testeo.xlsx';

		header("Content-Disposition: attachment; filename=$fileD");
		header('Content-Disposition: filename="Reporte_Testeando.xlsx"');
		header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

		readfile($fileD);
	}

	public function exportExcelUtilidadesTest(){

		$datos = json_decode(file_get_contents('php://input'));

		$renta_anual = $datos->renta_anual;
		$anio = $datos->anio;
		$nombres = $datos->trabajador;
		$dni = $datos->dni;
		$sector = $datos->sector;
		$renta_neta = $datos->renta_neta;
		$dias_laborados_individual = (int) $datos->dias_laborados_individual;
		$dias_laborad_global = (int) $datos->dias_laborad_global;
		$remuneracion_individual = $datos->remuneracion_individual;
		$remuneracion_global = $datos->remuneracion_global;
		$distribucion_dia = $datos->distribucion_dia;
		$distribucion_remuneracion = $datos->distribucion_remuneracion;
		$liqui_dia_laborado = $datos->liquidacion_dia_laborado;
		$liqui_remuneracion = $datos->liquidacion_remuneracion;
		$retencion_quinta = $datos->retencion_quinta_categoria;
		$retencion_judicial = $datos->retencion_judicial;
		$neto_pagado = $datos->neto_pagado;
		$fecha_actual = $datos->fecha_actual;

		try {

			$rutaInforme = BASEPATH."../project/reportes_jasper/reporteUtilidades.jasper";
			$path ="/var/lib/tomcat9/webapps/reporteUtilidades.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			//echo "clsssss -";

			$params = new Java("java.util.HashMap");

			$nombre_parametro1 = "renta_anual";
			$nombre_parametro2 = "anio";
			$nombre_parametro3 = "nombres";
			$nombre_parametro4 = "dni";
			$nombre_parametro5 = "sector";
			$nombre_parametro6 = "renta_neta";
			$nombre_parametro7 = "dias_laborados_individual";
			$nombre_parametro8 = "dias_laborad_global";
			$nombre_parametro9 = "remuneracion_individual";
			$nombre_parametro10 = "remuneracion_global";
			$nombre_parametro11 = "distribucion_dia";
			$nombre_parametro12 = "distribucion_remuneracion";
			$nombre_parametro13 = "liqui_dia_laborado";
			$nombre_parametro14 = "liqui_remuneracion";
			$nombre_parametro15 = "retencion_quinta";
			$nombre_parametro16 = "rentencion_judicial";
			$nombre_parametro17 = "neto_pagado";
			$nombre_parametro18 = "fecha_actual";

			$vp1 =  $renta_anual;
			$vp2 =  $anio;
			$vp3 =  $nombres;
			$vp4 =  $dni;
			$vp5 =  $sector;
			$vp6 =  $renta_neta;
			$vp7 =  $dias_laborados_individual;
			$vp8 =  $dias_laborad_global;
			$vp9 =  $remuneracion_individual;
			$vp10 =  $remuneracion_global;
			$vp11 =  $distribucion_dia;
			$vp12 =  $distribucion_remuneracion;
			$vp13 =  $liqui_dia_laborado;
			$vp14 =  $liqui_remuneracion;
			$vp15 =  $retencion_quinta;
			$vp16 =  $retencion_judicial;
			$vp17 =  $neto_pagado;
			$vp18 =  $fecha_actual;

			$params->put($nombre_parametro1, $vp1);
			$params->put($nombre_parametro2, $vp2);
			$params->put($nombre_parametro3, $vp3);
			$params->put($nombre_parametro4, $vp4);
			$params->put($nombre_parametro5, $vp5);
			$params->put($nombre_parametro6, $vp6);
			$params->put($nombre_parametro7, $vp7);
			$params->put($nombre_parametro8, $vp8);
			$params->put($nombre_parametro9, $vp9);
			$params->put($nombre_parametro10, $vp10);
			$params->put($nombre_parametro11, $vp11);
			$params->put($nombre_parametro12, $vp12);
			$params->put($nombre_parametro13, $vp13);
			$params->put($nombre_parametro14, $vp14);
			$params->put($nombre_parametro15, $vp15);
			$params->put($nombre_parametro16, $vp16);
			$params->put($nombre_parametro17, $vp17);
			$params->put($nombre_parametro18, $vp18);


			$informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC());


			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT, $informe);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());

			//echo " - exporter 01 - ";

			//EXPORTA EL REPORTE XLSX EN EL SERVIDOR
			$exporter->exportReport();
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			echo "ok";

		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}

	public function exportPDFUtilidades($dni, $fecha_nac){

		///*
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, OPTIONS");


		try {

			$rutaInforme = "/var/www/html/etl.agvperu.com/project/reportes_jasper/reporteUtilidadesDni.jasper";//
			$path ="/var/lib/tomcat9/webapps/reporteUtilidades.pdf";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			//echo "clsssss -";

			$params = new Java("java.util.HashMap");

			$nombre_parametro1 = "dni";
			$nombre_parametro2 = "fecha_nac";

			$vp1 =  $dni;
			$vp2 =  $fecha_nac;

			$params->put($nombre_parametro1, $vp1);
			$params->put($nombre_parametro2, $vp2);


			$informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC_agrosmart_qas());

			java_set_file_encoding("ISO-8859-1");
			$contentType = "application/pdf";
			$root = realpath(".");
			$path ="/var/lib/tomcat9/webapps/reporteUtilidades.pdf";
			java("net.sf.jasperreports.engine.JasperExportManager")->exportReportToPdfFile($informe, $path);

			$Namefile = "Reporte_utilidades_".$dni.".pdf";

			header("Content-Disposition: attachment; filename=$Namefile");
			// header("Content-Disposition:attachment;filename='Reporte_utilidades.pdf'");//Habre en una URL el pdf
			header("Content-type: " . $contentType);
			readfile($path);

			echo "ok ";

		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}


	public function downloadExcelJasperUtilidades(){

		$fileD = '/var/lib/tomcat9/webapps/reporteUtilidades.xlsx';

		header("Content-Disposition: attachment; filename=$fileD");
		header('Content-Disposition: filename="Reporte_Utilidades.xlsx"');
		header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

		readfile($fileD);
	}

	public function generarSolicitudVenta(){
		$this->load->model('VentaVacaciones_model');
		$empleado = $this->VentaVacaciones_model->getEmpleadoInfo($this->input->post('codigo_sap'));
		
		if(!$this->input->post('key_formatos_proceso')){

			$jefe = $this->VentaVacaciones_model->getJerarquiaEmpleado($this->input->post('codigo_sap'));
			$rrhh = $this->VentaVacaciones_model->getRecursosHumanos();
			$usuario = $this->session->userdata('USUARIO');
			$uvacaciones = $this->VentaVacaciones_model->getUsuarioBySap($this->input->post('codigo_sap'));
			$ujefe = $this->VentaVacaciones_model->getUsuarioBySap($jefe->codigo_sap_jefe);
			
			$this->VentaVacaciones_model->newFormatoSolicitudVenta([
				'key_programacion'      => 0,
				'nombre_fisico'         => $this->input->post('id_solicitud')."_".$empleado->numero_documento."_4.pdf",
				'estado'				=> 1,
				'idusuario_creador'		=> $usuario['idusuario'],
				'idusuario_vacaciones'	=> $uvacaciones->idusuario,
				'idusuario_jefe'		=> $ujefe->idusuario,
				'idusuario_rrhh'		=> $rrhh->value,
				'estado_proceso'		=> 4,
				'fecha_creacion'		=> date('Y-m-d H:i:s'),
				'key_solicitud_venta'	=> $this->input->post('id_solicitud')
			]);
		}
		try{

			$rutaInforme = BASEPATH."../project/reportes_jasper/formatoVentaVacaciones.jasper";
            $path = "/var/lib/tomcat9/webapps/".$this->input->post('id_solicitud')."_".$empleado->numero_documento.".pdf";

            $file = new Java ("java.io.File",$path);


            $sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

            $params = new Java("java.util.HashMap");

            $params->put("codigo_sap", $this->input->post('codigo_sap'));
            $params->put("periodo", $this->input->post('periodo'));
            $params->put("dias_solicitud", $this->input->post('dias'));
			$params->put("id_solicitud", $this->input->post('id_solicitud'));


            $informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC());


            java_set_file_encoding("ISO-8859-1");
            $contentType = "application/pdf";
            java("net.sf.jasperreports.engine.JasperExportManager")->exportReportToPdfFile($informe, $path);

            $file->setReadable(true, false);
            $file->setExecutable(true, false);
            $file->setWritable(true, false);

			$this->load->library('filesmanage');

			if($this->input->post('estado_anterior')) {
				$file = $this->input->post('id_solicitud')."_".$empleado->numero_documento."_".$this->input->post('estado_anterior').".pdf";
				$this->filesmanage->deleteArchivo('dms-vacaciones/venta-vacaciones/', $file);
			}
			$file = $this->input->post('id_solicitud')."_".$empleado->numero_documento."_".$this->input->post('estado_proceso').".pdf";
			$this->filesmanage->subirArchivo($path, 'dms-vacaciones/venta-vacaciones/', $file);

            //echo "Archivo PDF Generado en el Servidor";
			return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode(array(
						'message'   => 'Solicitud generada satisfactoriamente',
						'data'      => [
							'nombre_fisico'		=> $this->input->post('id_solicitud')."_".$empleado->numero_documento."_".$this->input->post('estado_proceso').".pdf",
						]
				)));

		}catch (JavaException $ex) {
            $trace = new Java("java.io.ByteArrayOutputStream");
            $ex->printStackTrace(new Java("java.io.PrintStream", $trace));
            //print "java stack trace: $trace\n";
			return $this->output
				->set_content_type('application/json')
				->set_status_header(500)
				->set_output(json_encode(array(
						'message'   => 'Ocurrio un error al generar la solicitud',
						'data'      => []
				)));
        }
	}


    public function exportPDFFormatoVacaciones(){

        $key_programacion =  $this->input->post('key_programacion');
        $dni_empleado =  $this->input->post('dni_empleado');

        $this->load->model('Formatos_proceso_model');
        $objEmpleadoSAP = $this->Formatos_proceso_model->getEmpleadoVacacionesSAP($dni_empleado);

        $vp1 =  $objEmpleadoSAP['apellido_paterno'];
        $vp2 =  $objEmpleadoSAP['apellido_materno'];
        $vp3 =  $objEmpleadoSAP['nombres'];
        $vp4 =  $objEmpleadoSAP['nombre_tipo_documento'];
        $vp5 =  $objEmpleadoSAP['area'];
        $vp6 =  $key_programacion;
        $vp7 =  $objEmpleadoSAP['codigo_sap'];

        try {

            $rutaInforme = BASEPATH."../project/reportes_jasper/nuevoFormatoVacaciones.jasper";
            $path = "/var/lib/tomcat9/webapps/".$dni_empleado."_".$key_programacion."_".$this->input->post('estado_proceso').".pdf";

            $file = new Java ("java.io.File",$path);


            $sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

            $params = new Java("java.util.HashMap");



            $params->put("ap_paterno", $vp1);
            $params->put("ap_materno", $vp2);
            $params->put("nombres", $vp3);
            $params->put("tipo_documento", $vp4);
            $params->put("area", $vp5);
            $params->put("key_programacion", $vp6);
            $params->put("codigo_sap", $vp7);


            $informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC());


            java_set_file_encoding("ISO-8859-1");
            $contentType = "application/pdf";
            java("net.sf.jasperreports.engine.JasperExportManager")->exportReportToPdfFile($informe, $path);

            $file->setReadable(true, false);
            $file->setExecutable(true, false);
            $file->setWritable(true, false);

			$this->load->library('filesmanage');

			if($this->input->post('estado_anterior')) {
				$file = $dni_empleado."_".$key_programacion."_".$this->input->post('estado_anterior').".pdf";
				$this->filesmanage->deleteArchivo('dms-vacaciones/solicitudes-vacaciones/', $file);
			}
			$file = $dni_empleado."_".$key_programacion."_".$this->input->post('estado_proceso').".pdf";
			$this->filesmanage->subirArchivo($path, 'dms-vacaciones/solicitudes-vacaciones/', $file);

            echo "Archivo PDF Generado en el Servidor";

        } catch (JavaException $ex) {
            $trace = new Java("java.io.ByteArrayOutputStream");
            $ex->printStackTrace(new Java("java.io.PrintStream", $trace));
            print "java stack trace: $trace\n";
        }
    }

		public function exportExcelEvaluacionesCampo(){

		//$contratista =  (int) $this->input->post('cboContratista');;
		//$tipo =  (int)$this->input->post('cboTipo');
		//$area =  (int) $this->input->post('cboArea');

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, OPTIONS");

		$contratista =  "";
		$tipo =  "";
		$area =  "";


		try {

			$rutaInforme_01 = BASEPATH."../project/reportes_jasper/reporteEvaluacionCampo.jasper";
            $rutaInforme_02 = BASEPATH."../project/reportes_jasper/reporteEvaluacionCapacitacionCampo.jasper";
			$path ="/var/lib/tomcat9/webapps/auditoria_testeo.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			//echo "clsssss -";

			$params = new Java("java.util.HashMap");

			$nombre_parametro1 = "contratista";
			$nombre_parametro2 = "tipo";
			$nombre_parametro3 = "area";

			$vp1 =  $contratista;
			$vp2 =  $tipo;
			$vp3 =  $area;

			$params->put($nombre_parametro1, $vp1);
			$params->put($nombre_parametro2, $vp2);
			$params->put($nombre_parametro3, $vp3);

            $JasperPrint= new java("net.sf.jasperreports.engine.JasperPrint");
            $paramList = new Java("java.util.ArrayList");
            $paramName = new Java("java.util.ArrayList");

            $Array = new JavaClass("java.lang.reflect.Array");
            $sheetNames = $Array->newInstance(new JavaClass("java.lang.String"), array(2));


			$informe01 = $sJfm->fillReport($rutaInforme_01,$params,$this->conexionJDBC_agrosmart_qas());
            $informe02 = $sJfm->fillReport($rutaInforme_02,$params,$this->conexionJDBC_agrosmart_qas());

            $paramList->add($informe01);
            $paramList->add($informe02);

            $sheetNames[0] = "Reporte_seguimiento_campo";
            $sheetNames[1] = "Reporte_capacitación_campo";


			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT_LIST, $paramList);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());
            $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->SHEET_NAMES, $sheetNames);

			//echo " - exporter 01 - ";

			//EXPORTA EL REPORTE XLSX EN EL SERVIDOR
			$exporter->exportReport();
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			echo "ok";

		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}

	public function downloadExcelJasperEvaluacionesCampo(){

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, OPTIONS");

		$fileD = '/var/lib/tomcat9/webapps/auditoria_testeo.xlsx';

		header("Content-Disposition: attachment; filename=$fileD");
		header('Content-Disposition: filename="Reporte_liderazgo_campo.xlsx"');
		header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

		readfile($fileD);
	}

    public function exportExcelEvaluacionesPacking(){

        //$contratista =  (int) $this->input->post('cboContratista');;
        //$tipo =  (int)$this->input->post('cboTipo');
        //$area =  (int) $this->input->post('cboArea');

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, OPTIONS");

        $contratista =  "";
        $tipo =  "";
        $area =  "";


        try {

            $rutaInforme_01 = BASEPATH."../project/reportes_jasper/reporteEvaluacionPacking.jasper";
            $rutaInforme_02 = BASEPATH."../project/reportes_jasper/reporteEvaluacionCapacitacionPacking.jasper";
            $path ="/var/lib/tomcat9/webapps/auditoria_testeo.xlsx";

            $file = new Java ("java.io.File",$path);
            $file->setReadable(true, false);
            $file->setExecutable(true, false);
            $file->setWritable(true, false);

            $sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

            //echo "clsssss -";

            $params = new Java("java.util.HashMap");

            $nombre_parametro1 = "contratista";
            $nombre_parametro2 = "tipo";
            $nombre_parametro3 = "area";

            $vp1 =  $contratista;
            $vp2 =  $tipo;
            $vp3 =  $area;

            $params->put($nombre_parametro1, $vp1);
            $params->put($nombre_parametro2, $vp2);
            $params->put($nombre_parametro3, $vp3);

            $JasperPrint= new java("net.sf.jasperreports.engine.JasperPrint");
            $paramList = new Java("java.util.ArrayList");
            $paramName = new Java("java.util.ArrayList");

            $Array = new JavaClass("java.lang.reflect.Array");
            $sheetNames = $Array->newInstance(new JavaClass("java.lang.String"), array(2));


            $informe01 = $sJfm->fillReport($rutaInforme_01,$params,$this->conexionJDBC_agrosmart_qas());
            $informe02 = $sJfm->fillReport($rutaInforme_02,$params,$this->conexionJDBC_agrosmart_qas());

            $paramList->add($informe01);
            $paramList->add($informe02);

            $sheetNames[0] = "Reporte_seguimiento_packing";
            $sheetNames[1] = "Reporte_capacitación_packing";


            $exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
            $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
            $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT_LIST, $paramList);
            $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());
            $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->SHEET_NAMES, $sheetNames);

            //echo " - exporter 01 - ";

            //EXPORTA EL REPORTE XLSX EN EL SERVIDOR
            $exporter->exportReport();
            $file->setReadable(true, false);
            $file->setExecutable(true, false);
            $file->setWritable(true, false);

            echo "ok";

        } catch (JavaException $ex) {
            $trace = new Java("java.io.ByteArrayOutputStream");
            $ex->printStackTrace(new Java("java.io.PrintStream", $trace));
            print "java stack trace: $trace\n";
        }
    }

    public function downloadExcelJasperEvaluacionesPacking(){

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, OPTIONS");

        $fileD = '/var/lib/tomcat9/webapps/auditoria_testeo.xlsx';

        header("Content-Disposition: attachment; filename=$fileD");
        header('Content-Disposition: filename="Reporte_liderazgo_packing.xlsx"');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

        readfile($fileD);
    }

    public function exportExcelPlanAccionPacking(){

        //$contratista =  (int) $this->input->post('cboContratista');;
        //$tipo =  (int)$this->input->post('cboTipo');
        //$area =  (int) $this->input->post('cboArea');

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, OPTIONS");

        $contratista =  "";
        $tipo =  "";
        $area =  "";


        try {

            $rutaInforme_01 = BASEPATH."../project/reportes_jasper/reportePlanAccionPacking.jasper";
            $path ="/var/lib/tomcat9/webapps/auditoria_testeo.xlsx";

            $file = new Java ("java.io.File",$path);
            $file->setReadable(true, false);
            $file->setExecutable(true, false);
            $file->setWritable(true, false);

            $sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

            //echo "clsssss -";

            $params = new Java("java.util.HashMap");

            $nombre_parametro1 = "contratista";
            $nombre_parametro2 = "tipo";
            $nombre_parametro3 = "area";

            $vp1 =  $contratista;
            $vp2 =  $tipo;
            $vp3 =  $area;

            $params->put($nombre_parametro1, $vp1);
            $params->put($nombre_parametro2, $vp2);
            $params->put($nombre_parametro3, $vp3);

            $JasperPrint= new java("net.sf.jasperreports.engine.JasperPrint");
            $paramList = new Java("java.util.ArrayList");
            $paramName = new Java("java.util.ArrayList");

            $Array = new JavaClass("java.lang.reflect.Array");
            $sheetNames = $Array->newInstance(new JavaClass("java.lang.String"), array(1));


            $informe01 = $sJfm->fillReport($rutaInforme_01,$params,$this->conexionJDBC_agrosmart_qas());

            $paramList->add($informe01);

            $sheetNames[0] = "Reporte_plan_acción_packing";

            $exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
            $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
            $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT_LIST, $paramList);
            $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());
            $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->SHEET_NAMES, $sheetNames);

            //echo " - exporter 01 - ";

            //EXPORTA EL REPORTE XLSX EN EL SERVIDOR
            $exporter->exportReport();
            $file->setReadable(true, false);
            $file->setExecutable(true, false);
            $file->setWritable(true, false);

            echo "ok";

        } catch (JavaException $ex) {
            $trace = new Java("java.io.ByteArrayOutputStream");
            $ex->printStackTrace(new Java("java.io.PrintStream", $trace));
            print "java stack trace: $trace\n";
        }
    }
    public function downloadExcelJasperPlanAccionPacking(){

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, OPTIONS");

        $fileD = '/var/lib/tomcat9/webapps/auditoria_testeo.xlsx';

        header("Content-Disposition: attachment; filename=$fileD");
        header('Content-Disposition: filename="Reporte_plan_accion_packing.xlsx"');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

        readfile($fileD);
    }

    public function exportExcelPlanAccionCampo(){

        //$contratista =  (int) $this->input->post('cboContratista');;
        //$tipo =  (int)$this->input->post('cboTipo');
        //$area =  (int) $this->input->post('cboArea');

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, OPTIONS");

        $contratista =  "";
        $tipo =  "";
        $area =  "";


        try {

            $rutaInforme_01 = BASEPATH."../project/reportes_jasper/reportePlanAccionCampo.jasper";
            $path ="/var/lib/tomcat9/webapps/auditoria_testeo.xlsx";

            $file = new Java ("java.io.File",$path);
            $file->setReadable(true, false);
            $file->setExecutable(true, false);
            $file->setWritable(true, false);

            $sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

            //echo "clsssss -";

            $params = new Java("java.util.HashMap");

            $nombre_parametro1 = "contratista";
            $nombre_parametro2 = "tipo";
            $nombre_parametro3 = "area";

            $vp1 =  $contratista;
            $vp2 =  $tipo;
            $vp3 =  $area;

            $params->put($nombre_parametro1, $vp1);
            $params->put($nombre_parametro2, $vp2);
            $params->put($nombre_parametro3, $vp3);

            $JasperPrint= new java("net.sf.jasperreports.engine.JasperPrint");
            $paramList = new Java("java.util.ArrayList");
            $paramName = new Java("java.util.ArrayList");

            $Array = new JavaClass("java.lang.reflect.Array");
            $sheetNames = $Array->newInstance(new JavaClass("java.lang.String"), array(1));


            $informe01 = $sJfm->fillReport($rutaInforme_01,$params,$this->conexionJDBC_agrosmart_qas());

            $paramList->add($informe01);

            $sheetNames[0] = "Reporte_plan_acción_campo";

            $exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
            $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
            $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT_LIST, $paramList);
            $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());
            $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->SHEET_NAMES, $sheetNames);

            //echo " - exporter 01 - ";

            //EXPORTA EL REPORTE XLSX EN EL SERVIDOR
            $exporter->exportReport();
            $file->setReadable(true, false);
            $file->setExecutable(true, false);
            $file->setWritable(true, false);

            echo "ok";

        } catch (JavaException $ex) {
            $trace = new Java("java.io.ByteArrayOutputStream");
            $ex->printStackTrace(new Java("java.io.PrintStream", $trace));
            print "java stack trace: $trace\n";
        }
    }
    public function downloadExcelJasperPlanAccionCampo(){

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, OPTIONS");

        $fileD = '/var/lib/tomcat9/webapps/auditoria_testeo.xlsx';

        header("Content-Disposition: attachment; filename=$fileD");
        header('Content-Disposition: filename="Reporte_plan_accion_campo.xlsx"');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

        readfile($fileD);
    }
	
		public function exportExcelPreembarque(){

		//$contratista =  (int) $this->input->post('cboContratista');;
		//$tipo =  (int)$this->input->post('cboTipo');
		//$area =  (int) $this->input->post('cboArea');

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, OPTIONS");

		$contratista =  "";
		$tipo =  "";
		$area =  "";


		try {

			$rutaInforme_01 = BASEPATH."../project/reportes_jasper/reportePreembarque.jasper";
			$path ="/var/lib/tomcat9/webapps/auditoria_testeo.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			//echo "clsssss -";

			$params = new Java("java.util.HashMap");

			$nombre_parametro1 = "contratista";
			$nombre_parametro2 = "tipo";
			$nombre_parametro3 = "area";

			$vp1 =  $contratista;
			$vp2 =  $tipo;
			$vp3 =  $area;

			$params->put($nombre_parametro1, $vp1);
			$params->put($nombre_parametro2, $vp2);
			$params->put($nombre_parametro3, $vp3);

			$JasperPrint= new java("net.sf.jasperreports.engine.JasperPrint");
			$paramList = new Java("java.util.ArrayList");
			$paramName = new Java("java.util.ArrayList");

			$Array = new JavaClass("java.lang.reflect.Array");
			$sheetNames = $Array->newInstance(new JavaClass("java.lang.String"), array(1));


			$informe01 = $sJfm->fillReport($rutaInforme_01,$params,$this->conexionJDBC_agrosmart_qas());

			$paramList->add($informe01);

			$sheetNames[0] = "Reporte_preembarque";

			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT_LIST, $paramList);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->SHEET_NAMES, $sheetNames);

			//echo " - exporter 01 - ";

			//EXPORTA EL REPORTE XLSX EN EL SERVIDOR
			$exporter->exportReport();
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			echo "ok";

		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}

	public function downloadExcelJasperPreembarque(){

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, OPTIONS");

		$fileD = '/var/lib/tomcat9/webapps/auditoria_testeo.xlsx';

		header("Content-Disposition: attachment; filename=$fileD");
		header('Content-Disposition: filename="Reporte_preembarque.xlsx"');
		header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

		readfile($fileD);
	}


	public function exportExcelTrabajadoresSAP(){

		$estado=$_POST['cboEstado'];

		try {
			$rutaInforme = BASEPATH."../project/reportes_jasper/exportTrabajadoresSAP.jasper";

			$path ="/var/lib/tomcat9/webapps/exportTrabajadoresSAP.xlsx";

			$file = new Java ("java.io.File",$path);
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			$sJfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

			$params = new Java("java.util.HashMap");
			$params->put("estado", $estado);

			$informe = $sJfm->fillReport($rutaInforme,$params,$this->conexionJDBC());

			$exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRXlsxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);// DESACTIVAR FONDO BLANCO SIN CELDAS
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->JASPER_PRINT, $informe);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->OUTPUT_FILE_NAME, $file->getAbsolutePath());


			//EXPORTA EL REPORTE XLSX EN EL SERVIDOR
			$exporter->exportReport();
			$file->setReadable(true, false);
			$file->setExecutable(true, false);
			$file->setWritable(true, false);

			// shell_exec('sudo chmod -R 777 /var/lib/tomcat9/webapps/areasSecciones.xlsx');

		} catch (JavaException $ex) {
			$trace = new Java("java.io.ByteArrayOutputStream");
			$ex->printStackTrace(new Java("java.io.PrintStream", $trace));
			print "java stack trace: $trace\n";
		}
	}



	public function downloadExcelTrabajadoresSAP(){
		$fileD = '/var/lib/tomcat9/webapps/exportTrabajadoresSAP.xlsx';

		header("Content-Disposition: attachment; filename=$fileD");
		header('Content-Disposition: filename="DMS-Reporte_Trabajadores_SAP.xlsx"');
		header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

		readfile($fileD);
	}

}
