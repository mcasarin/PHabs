<?php
require_once "vendor/autoload.php";
require_once "../include/connect.php";
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
$spreadsheet = new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);
 
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();
 
$activeSheet->setCellValue('A1', 'Nome');
$activeSheet->setCellValue('B1', 'Empresa');
$activeSheet->setCellValue('C1', 'Matricula');
$activeSheet->setCellValue('D1', 'Cartao');
$activeSheet->setCellValue('E1', 'Remota');
$activeSheet->setCellValue('F1', 'Data');
$activeSheet->setCellValue('G1', 'Hora');
$activeSheet->setCellValue('H1', 'Acesso');
 
$query = $db->query("SELECT * FROM relusuario ORDER BY Data,hora DESC");
 
if($query->num_rows > 0) {
    $i = 2;
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('A'.$i , $row['nome']);
        $activeSheet->setCellValue('B'.$i , $row['empresa']);
        $activeSheet->setCellValue('C'.$i , $row['matricula']);
        $activeSheet->setCellValue('D'.$i , $row['cartao']);
        $activeSheet->setCellValue('E'.$i , $row['remota']);
        $activeSheet->setCellValue('F'.$i , $row['data']);
        $activeSheet->setCellValue('G'.$i , $row['hora']);
        $activeSheet->setCellValue('H'.$i , $row['acesso']);
        $i++;
    }
}
 
$filename = 'relatorio_usuario.xlsx';
 
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
?>