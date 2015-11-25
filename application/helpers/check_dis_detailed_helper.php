<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function check_dis_detailed($data){
                  /**
                  * PHPExcel
                  *
                  * Copyright (C) 2006 - 2014 PHPExcel
                  *
                  * This library is free software; you can redistribute it and/or
                  * modify it under the terms of the GNU Lesser General Public
                  * License as published by the Free Software Foundation; either
                  * version 2.1 of the License, or (at your option) any later version.
                  *
                  * This library is distributed in the hope that it will be useful,
                  * but WITHOUT ANY WARRANTY; without even the implied warranty of
                  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
                  * Lesser General Public License for more details.
                  *
                  * You should have received a copy of the GNU Lesser General Public
                  * License along with this library; if not, write to the Free Software
                  * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
                  *
                  * @category   PHPExcel
                  * @package    PHPExcel
                  * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
                  * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
                  * @version    1.8.0, 2014-03-02
                  */

                  /** Error reporting */
                  error_reporting(E_ALL);
                  ini_set('display_errors', TRUE);
                  ini_set('display_startup_errors', TRUE);

                  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

                  date_default_timezone_set('Europe/London');


                  /**
                  * PHPExcel
                  *
                  * Copyright (C) 2006 - 2014 PHPExcel
                  *
                  * This library is free software; you can redistribute it and/or
                  * modify it under the terms of the GNU Lesser General Public
                  * License as published by the Free Software Foundation; either
                  * version 2.1 of the License, or (at your option) any later version.
                  *
                  * This library is distributed in the hope that it will be useful,
                  * but WITHOUT ANY WARRANTY; without even the implied warranty of
                  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
                  * Lesser General Public License for more details.
                  *
                  * You should have received a copy of the GNU Lesser General Public
                  * License along with this library; if not, write to the Free Software
                  * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
                  *
                  * @category   PHPExcel
                  * @package    PHPExcel
                  * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
                  * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
                  * @version    1.8.0, 2014-03-02
                  */

                  /** Error reporting */
                  error_reporting(E_ALL);

                  /** Include PHPExcel */
                  require_once dirname(__FILE__) . '../Classes/PHPExcel.php';


                  // Create new PHPExcel object
                  //echo date('H:i:s') , " Create new PHPExcel object" , EOL;
                  $objPHPExcel = new PHPExcel();

                  // Set document properties
                  //echo date('H:i:s') , " Set document properties" , EOL;
                  $objPHPExcel->getProperties()->setCreator("EPSI")
                  ->setLastModifiedBy("MAC")
                  ->setTitle("Check Disbursement")
                  ->setSubject("Report")
                  ->setDescription("Deatiled Report");
                   // ->setKeywords("Employee DTR Summary")
                   // ->setCategory("Employee DTR Summary");


                  // Create a first sheet, representing sales data

                  //HEADER
                  $objRichText = new PHPExcel_RichText();
                  $objPayable = $objRichText->createTextRun('EXCELLENT PERFORMANCE SERVICES INC.');
                  $objPayable->getFont()->setBold(true);
                  $objPayable->getFont()->setSize(14);
                  $objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_BLACK ) );
                  $objPHPExcel->getActiveSheet()->getCell('A1')->setValue($objRichText);

                  //DESCRIPTION
                  $objRichText = new PHPExcel_RichText();
                  $objPayable = $objRichText->createTextRun('CHECK DISBURSEMENT DETAILED REPORT');
                  $objPayable->getFont()->setBold(true);
                  $objPayable->getFont()->setSize(12);
                  $objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_BLACK ) );
                  $objPHPExcel->getActiveSheet()->getCell('A2')->setValue($objRichText);

                  //COVERED DATE
                  $objRichText = new PHPExcel_RichText();
                  $objPayable = $objRichText->createTextRun('MM/DD/YYYY');
                  $objPayable->getFont()->setBold(true);
                  $objPayable->getFont()->setSize(12);
                  $objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_BLACK ) );
                  $objPHPExcel->getActiveSheet()->getCell('A3')->setValue($objRichText);
                  
                  // Put COntent in the cell. Declare first the cell location, then put the content. -mich
                  $objPHPExcel->setActiveSheetIndex(0);
                  $newdata = $data->result_array();  
                  $objPHPExcel->getActiveSheet()->setCellValue('F4', 'CASH INBANK');
                  $objPHPExcel->getActiveSheet()->setCellValue('A5', 'DATE');
                  $objPHPExcel->getActiveSheet()->setCellValue('B5', 'CV#');
                  $objPHPExcel->getActiveSheet()->setCellValue('C5', 'CHECK #');
                  $objPHPExcel->getActiveSheet()->setCellValue('D5', 'PAYEE');
                  $objPHPExcel->getActiveSheet()->setCellValue('E5', 'PRTICULARS');
                  $objPHPExcel->getActiveSheet()->setCellValue('F5', 'EW-LP');
                  $objPHPExcel->getActiveSheet()->setCellValue('G5', 'BDO');

                  // STYLING CELLS -mich
                  
                  // MERGE CELLS
                  $objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
                  $objPHPExcel->getActiveSheet()->mergeCells('A2:E2');
                  $objPHPExcel->getActiveSheet()->mergeCells('A3:E3');
                  $objPHPExcel->getActiveSheet()->mergeCells('F4:G4');

                  // SET COLUMN WIDTH
                  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
                  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
                  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);

                  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                  $objPHPExcel->setActiveSheetIndex(0);


                  /** Include PHPExcel_IOFactory */
                  require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';


                  // Save Excel 2007 file
                  //echo date('H:i:s') , " Write to Excel2007 format" , EOL;
                  $callStartTime = microtime(true);

                  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                  $objWriter->save('Reports/Check_Dis/Detailed/detailed_'.date("Y-m-d").'.xls');
                  $callEndTime = microtime(true);
                  $callTime = $callEndTime - $callStartTime;

                  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
                  //echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
                  // Echo memory usage
                  //echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


                  // Save Excel 95 file
                  // echo date('H:i:s') , " Write to Excel5 format" , EOL;
                  // $callStartTime = microtime(true);

                  // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                  // $objWriter->save(str_replace('.php', '.xls', __FILE__));
                  // $callEndTime = microtime(true);
                  // $callTime = $callEndTime - $callStartTime;

                  // echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
                  // echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
                  // // Echo memory usage
                  // echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


                  // // Echo memory peak usage
                  // echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

                  // // Echo done
                  // echo date('H:i:s') , " Done writing files" , EOL;
                  // echo 'Files have been created in ' , getcwd() , EOL;
            }