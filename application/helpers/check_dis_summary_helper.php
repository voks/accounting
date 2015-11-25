<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function check_dis_summary($data){
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
                  $sheet = $objPHPExcel->getActiveSheet();
                  //HEADER
                  $objRichText = new PHPExcel_RichText();
                  $objPayable = $objRichText->createTextRun('EXCELLENT PERFORMANCE SERVICES INC.');
                  $objPayable->getFont()->setBold(true);
                  $objPayable->getFont()->setSize(14);
                  $objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_BLACK ) );
                  $sheet->getCell('A1')->setValue($objRichText);

                  //DESCRIPTION
                  $objRichText = new PHPExcel_RichText();
                  $objPayable = $objRichText->createTextRun('CHECK DISBURSEMENT SUMMARY REPORT');
                  $objPayable->getFont()->setBold(true);
                  $objPayable->getFont()->setSize(12);
                  $objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_BLACK ) );
                  $sheet->getCell('A2')->setValue($objRichText);

                  //COVERED DATE
                  $objRichText = new PHPExcel_RichText();
                  $objPayable = $objRichText->createTextRun('MM/DD/YYYY');
                  $objPayable->getFont()->setBold(true);
                  $objPayable->getFont()->setSize(12);
                  $objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_BLACK ) );
                  $sheet->getCell('A3')->setValue($objRichText);
                  
                  // Put COntent in the cell. Declare first the cell location, then put the content. -mich
                  $objPHPExcel->setActiveSheetIndex(0);
                  $newdata = $data->result_array();  
                  $sheet->setCellValue('A5', 'ACCOUNT TITLE');
                  $sheet->setCellValue('B5', '');
                  $sheet->setCellValue('C5', 'DEBIT');
                  $sheet->setCellValue('D5', 'CREDIT');

                  $counts = 6;
                  foreach ($data->result() as $key) {
                        $sheet->setCellValue("A".$counts."", $key->account_name);
                        $sheet->setCellValue("C".$counts."", $key->trans_dr);
                        $sheet->setCellValue("D".$counts."", $key->trans_cr);
                        $counts++;
                  }

                  // STYLING CELLS -mich
                  // FORMAT THE NUMBER IN SPECIFIC CELL
                  $sheet->getStyle('C6:C30')->getNumberFormat()->setFormatCode('#,##0.00');
                  $sheet->getStyle('D6:D30')->getNumberFormat()->setFormatCode('#,##0.00');
                  // MERGE CELLS
                  $sheet->mergeCells('A1:E1');
                  $sheet->mergeCells('A2:E2');
                  $sheet->mergeCells('A3:E3');

                  // SET COLUMN WIDTH
                  $sheet->getColumnDimension('A')->setWidth(60);
                  $sheet->getColumnDimension('B')->setWidth(10);
                  $sheet->getColumnDimension('C')->setWidth(20);
                  $sheet->getColumnDimension('D')->setWidth(20);

                  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                  $objPHPExcel->setActiveSheetIndex(0);


                  /** Include PHPExcel_IOFactory */
                  require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';


                  // Save Excel 2007 file
                  //echo date('H:i:s') , " Write to Excel2007 format" , EOL;
                  $callStartTime = microtime(true);

                  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                  $objWriter->save('Reports/Check_Dis/Summary/summary_'.date("Y-m-d").'.xls');
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