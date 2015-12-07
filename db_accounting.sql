-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2015 at 10:57 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_accounting`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_account_groups`
--

CREATE TABLE IF NOT EXISTS `tb_account_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type` varchar(225) NOT NULL,
  `account_groupname` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `tb_account_groups`
--

INSERT INTO `tb_account_groups` (`id`, `account_type`, `account_groupname`) VALUES
(11, 'Assets', 'Cash in Bank - Current Account'),
(12, 'Assets', 'Cash in Bank - Dollar Account'),
(13, 'Assets', 'Prepaid Expenses'),
(14, 'Assets', 'Accounts Receivable'),
(15, 'Assets', 'Advances of Employees'),
(16, 'Assets', 'Advances of Officers'),
(17, 'Assets', 'Security Deposit'),
(18, 'Assets', 'Prepaid Rent'),
(19, 'Liabilities', 'Accrued Salaries and Wages '),
(20, 'Liabilities', 'Accounts Payable - Trade'),
(21, 'Liabilities', 'Accounts Payble - Non Trade'),
(22, 'Liabilities', 'Accounts Payable - Others'),
(23, 'Liabilities', 'Employees Witholding Tax Payable '),
(24, 'Liabilities', 'Accrued EI'),
(25, 'Liabilities', 'Accrued Income Tax'),
(26, 'Capital', 'Paid In Capital'),
(27, 'Capital', 'Common Stock Class A'),
(28, 'Capital', 'Unrealized Foreign Exchange Gain (Loss)'),
(29, 'Capital', 'Tax Refunds'),
(30, 'Capital', 'Income Tax Paid'),
(31, 'Capital', 'Dividends Declared'),
(32, 'Capital', 'Net Income (Loss)'),
(33, 'Revenue', 'Service Revenue'),
(34, 'Revenue', 'Interest Income'),
(35, 'Expense', 'Rent Expenses'),
(36, 'Expense', 'Salaries and Wages Expense'),
(37, 'Expense', 'Travel Expenses'),
(38, 'Expense', 'Hotel and Accomodation Expenses'),
(39, 'Expense', 'Sales Expenses'),
(40, 'Expense', 'Association Dues Expenses'),
(41, 'Expense', 'Interest Expenses'),
(42, 'Expense', 'Light and Water Expenses'),
(43, 'Expense', 'Management Fee Expenses'),
(44, 'Expense', 'Training Allowances'),
(45, 'Expense', 'Gasoline and Oil Expenses'),
(46, 'Expense', 'Miscellaneous Expenses'),
(47, 'Expense', 'Representation Expenses'),
(48, 'Expense', 'SSS Employer Share'),
(49, 'Expense', 'Pag Ibig Employer Share'),
(50, 'Expense', 'Philhealth Employer Share'),
(51, 'Expense', 'Office Supplies Expenses'),
(52, 'Expense', 'Professional Fees Expenses '),
(53, 'Expense', 'Business Tax and Licenses'),
(55, 'Assets', 'Cash on hand'),
(56, 'Assets', 'Cash in Bank'),
(57, 'Assets', 'Cash and Cash Equivalent'),
(58, 'Liabilities', 'Saving Deposits'),
(59, 'Liabilities', 'Time Deposits'),
(60, 'Capital', 'Common Share Capital-Autorized');

-- --------------------------------------------------------

--
-- Table structure for table `tb_account_subsidiary`
--

CREATE TABLE IF NOT EXISTS `tb_account_subsidiary` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `sub_date` varchar(255) NOT NULL,
  `account_code` int(11) NOT NULL,
  `account_title` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `sub_code` varchar(255) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `master_link` varchar(50) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tb_account_subsidiary`
--

INSERT INTO `tb_account_subsidiary` (`sub_id`, `project_id`, `sub_date`, `account_code`, `account_title`, `account_type`, `sub_code`, `sub_name`, `master_link`) VALUES
(1, 2, '08/22/2015', 40001, 'Accounts Receivable Trade', 'Revenue', '40001 - 00001', 'Accounts Receivable Trade - Sommers Systems', '00001'),
(2, 2, '08/22/2015', 40001, 'Accounts Receivable Trade', 'Revenue', '40001 - 00002', 'Accounts Receivable Trade - DevCon Inc', '00002'),
(3, 2, '08/22/2015', 20001, 'Accounts Payable Trade', 'Liabilities', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '00003'),
(4, 2, '08/22/2015', 10001, 'Cash in Bank', 'Assets', '10001 - 10000', 'Cash in Bank - BDO San Juan', '00000'),
(5, 2, '08/22/2015', 10001, 'Cash in Bank', 'Assets', '10001 - 10001', 'Cash in Bank - Metro Bank Commonwealth', '00000'),
(6, 2, '08/22/2015', 10001, 'Cash in Bank', 'Assets', '10001 - 10003', 'Cash in Bank - China Bank Regalado', '00000'),
(7, 2, '08/22/2015', 40004, 'Sales Revenue', 'Revenue', '40004 - 40001', 'Sales Revenue - Sommers Systems', '00001'),
(8, 2, '08/22/2015', 40004, 'Sales Revenue', 'Revenue', '40004 - 40002', 'Sales Revenue - DevCon Inc', '00002'),
(9, 2, '08/23/2015', 20003, 'Accounts Payable Others', 'Liabilities', '20003 - 10000', 'Accounts Payable Others - Asticom Employees Salary and Benefits', '00004'),
(10, 2, '08/23/2015', 50002, 'Programmers System Unit Maintenance', 'Expense', '50002 - 10007', 'Programmers System Unit Maintenance -  Expense', '00003');

-- --------------------------------------------------------

--
-- Table structure for table `tb_account_title`
--

CREATE TABLE IF NOT EXISTS `tb_account_title` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `account_date` varchar(255) NOT NULL,
  `account_code` varchar(255) NOT NULL,
  `account_title` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `account_group` varchar(255) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tb_account_title`
--

INSERT INTO `tb_account_title` (`account_id`, `project_id`, `account_date`, `account_code`, `account_title`, `account_type`, `account_group`) VALUES
(1, 2, '08/20/2015', '40001', 'Accounts Receivable Trade', 'Revenue', 'test'),
(2, 2, '08/20/2015', '40002', 'Accounts Receivable Non Trade', 'Revenue', 'test'),
(3, 2, '08/20/2015', '40003', 'Accounts Receivable Others', 'Revenue', 'test'),
(4, 2, '08/22/2015', '20001', 'Accounts Payable Trade', 'Liabilities', 'Accounts Payable - Trade'),
(5, 2, '08/22/2015', '20002', 'Accounts Payable Non Trade', 'Liabilities', 'test'),
(6, 2, '08/22/2015', '20003', 'Accounts Payable Others', 'Liabilities', 'test'),
(7, 2, '08/22/2015', '50001', 'Office Supplies', 'Expense', 'test'),
(8, 2, '08/22/2015', '50002', 'Programmers System Unit Maintenance', 'Expense', 'test'),
(9, 2, '08/22/2015', '10001', 'Cash in Bank', 'Assets', 'test'),
(10, 2, '08/22/2015', '40004', 'Sales Revenue', 'Revenue', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tb_audit_trail`
--

CREATE TABLE IF NOT EXISTS `tb_audit_trail` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `a_action` varchar(255) NOT NULL,
  `a_date` date NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `tb_audit_trail`
--

INSERT INTO `tb_audit_trail` (`a_id`, `project_id`, `user_id`, `a_action`, `a_date`) VALUES
(1, 2, 9, 'Added New Accounts Payable', '0000-00-00'),
(2, 2, 9, 'Added New Accounts Payable', '0000-00-00'),
(3, 2, 9, 'Added New Accounts Payable', '0000-00-00'),
(4, 2, 9, 'Added New Accounts Payable', '0000-00-00'),
(5, 2, 9, 'Added New Accounts Payable', '0000-00-00'),
(6, 2, 9, 'Added New Accounts Payable', '0000-00-00'),
(7, 2, 9, 'Added New Accounts Payable', '0000-00-00'),
(8, 2, 9, 'Added New Accounts Payable', '0000-00-00'),
(9, 2, 9, 'Added New Accounts Payable', '2015-12-07'),
(10, 2, 2, 'Added New Accounts Payable', '2015-12-07'),
(11, 2, 2, 'Added New Accounts Payable', '2015-12-30'),
(12, 2, 2, 'Added New Accounts Payable - !', '2015-12-07'),
(13, 2, 2, 'Added New Accounts Payable - 0jjjj!', '2015-12-07'),
(14, 2, 2, 'Added New Accounts Payable Record. Invoice#:15-999.', '2015-12-07'),
(15, 2, 2, 'Added New Accounts Payable Record. Invoice#:15-324', '2015-12-07'),
(16, 2, 2, 'Added New Accounts Payable Record. Invoice#:12-1212.', '2015-12-07'),
(17, 2, 2, 'Added New Accounts Payable Record. Invoice#:15-0002', '2015-12-07'),
(18, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(19, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(20, 2, 2, 'Searched Records in AP. Using the these key word:,,', '2015-12-07'),
(21, 2, 2, 'Searched Records in AP. Using the these key word:123,07/26/2015,12/31/2015', '2015-12-07'),
(22, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(23, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(24, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(25, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(26, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(27, 2, 2, 'Generated Billing Invoice with invoice#:', '2015-12-07'),
(28, 2, 2, 'Generated Billing Invoice with invoice#:', '2015-12-07'),
(29, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(30, 2, 2, 'Generated Billing Invoice with invoice#:', '2015-12-07'),
(31, 2, 2, 'Generated Billing Invoice with invoice#:2', '2015-12-07'),
(32, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(33, 2, 2, 'Generated Billing Invoice with invoice#:', '2015-12-07'),
(34, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(35, 2, 2, 'Generated Billing Invoice with invoice#:', '2015-12-07'),
(36, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(37, 2, 2, 'Generated Billing Invoice with invoice#:', '2015-12-07'),
(38, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(39, 2, 2, 'Generated Billing Invoice with invoice#:123', '2015-12-07'),
(40, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(41, 2, 2, 'Generated Billing Invoice Summary', '2015-12-07'),
(42, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(43, 2, 2, 'Generated Billing Report in an Excel Format', '2015-12-07'),
(44, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(45, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(46, 2, 2, 'Updated Billing Record with BI#:', '2015-12-07'),
(47, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(48, 2, 2, 'Updated Billing Record with BI#:', '2015-12-07'),
(49, 2, 2, 'Updated Billing Record with BI#:', '2015-12-07'),
(50, 2, 2, 'Updated Billing Record with BI#:', '2015-12-07'),
(51, 2, 2, 'Updated Billing Record with BI#:', '2015-12-07'),
(52, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(53, 2, 2, 'Updated Billing Record with BI#:', '2015-12-07'),
(54, 2, 2, 'Searched Records in CD.', '2015-12-07'),
(55, 2, 2, 'Searched Records in CD.', '2015-12-07'),
(56, 2, 2, 'Generated Check ()', '2015-12-07'),
(57, 2, 2, 'Generated Check ()', '2015-12-07'),
(58, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(59, 2, 2, 'Generated Billing Invoice(123)', '2015-12-07'),
(60, 2, 2, 'Searched Records in CD.', '2015-12-07'),
(61, 2, 2, 'Generated Check (156)', '2015-12-07'),
(62, 2, 2, 'Searched Records in CD.', '2015-12-07'),
(63, 2, 2, 'Generated Check Voucher (145)', '2015-12-07'),
(64, 2, 2, 'Generated Check Disbursement Summary(PDF Format)', '2015-12-07'),
(65, 2, 2, 'Generated Detailed Check Disbursement (Excel Format', '2015-12-07'),
(66, 2, 2, 'Generated Sumary Check Disbursement (Excel Format)', '2015-12-07'),
(67, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(68, 2, 2, 'Generated Billing Invoice(123)', '2015-12-07'),
(69, 2, 2, 'Searched Records in AP.', '2015-12-07'),
(70, 2, 2, 'Generated Billing Invoice(123)', '2015-12-07'),
(71, 2, 2, 'Generated Billing Invoice(123)', '2015-12-07'),
(72, 2, 2, 'Generated Billing Invoice(123)', '2015-12-07'),
(73, 2, 2, 'Generated Billing Invoice(123)', '2015-12-07'),
(74, 2, 2, 'Generated Billing Invoice(123)', '2015-12-07'),
(75, 2, 2, 'Generated Sales Summary Report (PDF Format)', '2015-12-07'),
(76, 2, 2, 'Searched Record in Sales Journal', '2015-12-07'),
(77, 2, 2, 'Generated Billing Invoice()', '2015-12-07'),
(78, 2, 2, 'Searched Record in Sales Journal', '2015-12-07'),
(79, 2, 2, 'Generated Billing Invoice(1234)', '2015-12-07'),
(80, 2, 2, 'Added New Cash Receipts Record. OR#:123456789', '2015-12-07'),
(81, 2, 2, 'Searched Records in Check Disbursement.', '2015-12-07'),
(82, 2, 2, 'Generated Check Voucher (145)', '2015-12-07'),
(83, 2, 2, 'Generated Check (156)', '2015-12-07'),
(84, 2, 2, 'Searched Records in Cash Receipts.', '2015-12-07'),
(85, 2, 2, 'Generated Cash Receipt Report()', '2015-12-07'),
(86, 2, 2, 'Generated Cash Receipt Report()', '2015-12-07'),
(87, 2, 2, 'Searched Records in Cash Receipts.', '2015-12-07'),
(88, 2, 2, 'Generated Cash Receipt Report(12)', '2015-12-07'),
(89, 2, 2, 'Generated Cash Receipts Summary Report (PDF)', '2015-12-07'),
(90, 2, 2, 'Added New General Journal Record. Journal#:15-002-023', '2015-12-07'),
(91, 2, 2, 'Searched Records in General Jouranl.', '2015-12-07'),
(92, 2, 2, 'Generated Jouranl Report(15-002-023)', '2015-12-07'),
(93, 2, 2, 'Generated Journal Summary Report (PDF)', '2015-12-07'),
(94, 2, 2, 'Generated Jouranl Report(15-002-023)', '2015-12-07'),
(95, 2, 2, 'Generated Journal Summary Report (PDF)', '2015-12-07'),
(96, 2, 2, 'Generated Journal Summary Report (PDF)', '2015-12-07'),
(97, 2, 2, 'Generated Journal Summary Report (PDF)', '2015-12-07'),
(98, 2, 2, 'Generated Journal Summary Report (PDF)', '2015-12-07'),
(99, 2, 2, 'System Login', '2015-12-07'),
(100, 2, 2, 'System Logout', '2015-12-07'),
(101, 2, 2, 'System Login', '2015-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bank_recon`
--

CREATE TABLE IF NOT EXISTS `tb_bank_recon` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_month` varchar(255) NOT NULL,
  `bank_year` varchar(255) NOT NULL,
  `bank_balance` varchar(255) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tb_bank_recon`
--

INSERT INTO `tb_bank_recon` (`bank_id`, `project_id`, `bank_name`, `bank_month`, `bank_year`, `bank_balance`) VALUES
(1, 0, 'BANCO DE ORO', 'July', '2005', '12,000,000.00'),
(2, 0, 'BANCO DE ORO', 'July', '2005', '1,000,000.00'),
(3, 0, 'BANK OF THE PHILIPPINES', 'July', '2005', '250,000.00'),
(4, 0, 'BDO San Juan', 'August', '2015', '1000000'),
(5, 0, 'Cash in Bank - BDO San Juan', 'August', '2015', '1000000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_copyrights`
--

CREATE TABLE IF NOT EXISTS `tb_copyrights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `footer` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_copyrights`
--

INSERT INTO `tb_copyrights` (`id`, `company_name`, `year`, `footer`) VALUES
(4, 'EPSI (Excellent Performance Services Inc.)', '2015', 'Licensed software of PNI International Corporation. Reproduction in any format, digital or otherwise, for purposes of publication, display or distribution without written consent of the Developer is prohibited. PNI International Corporation © 2014. All rights reserved.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_journal_ap`
--

CREATE TABLE IF NOT EXISTS `tb_journal_ap` (
  `ap_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `ap_invoice_no` varchar(255) NOT NULL,
  `ap_invoice_date` varchar(255) NOT NULL,
  `ap_po_no` varchar(255) NOT NULL,
  `ap_terms` varchar(255) NOT NULL,
  `ap_master_name` varchar(255) NOT NULL,
  `ap_invoice_amount` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_trans_id` varchar(255) NOT NULL,
  `total_debit` varchar(225) NOT NULL,
  `total_credit` varchar(225) NOT NULL,
  PRIMARY KEY (`ap_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tb_journal_ap`
--

INSERT INTO `tb_journal_ap` (`ap_id`, `project_id`, `ap_invoice_no`, `ap_invoice_date`, `ap_po_no`, `ap_terms`, `ap_master_name`, `ap_invoice_amount`, `ap_particulars`, `ap_trans_id`, `total_debit`, `total_credit`) VALUES
(1, 2, '123', '09/10/2015', '123', '7', 'PC Express Computer Supplies', '11000.00', 'To record computer', '', ' 11000.00', ' 11000.00'),
(2, 2, '1234', '09/10/2015', '1234', '7', 'PC Express Computer Supplies', '11000.00', 'To reocord PC', '', '11000.00', ' 11000.00'),
(3, 2, '12345', '09/10/2015', '12345', '7', 'PC Express Computer Supplies', '11000.00', 'To record PC', '', '11000.00', '11000.00'),
(4, 2, '1224', '09/09/2015', '1224', '30', 'PC Express Computer Supplies', '21000.00', 'to record pc', '', ' 21000.00', ' 21000.00'),
(5, 2, '2234', '09/10/2015', '2234', '15', 'PC Express Computer Supplies', '3000.00', 'To Record PC', '', ' 3000.00', ' 3000.00'),
(6, 2, '3324', '09/10/2015', '3324', '7', 'PC Express Computer Supplies', '900.00', 'To record', '', ' 900.00', ' 900.00'),
(7, 2, '12333333', '11/29/2015', '35435456565656', '15', 'PC Express Computer Supplies', '4545.00', 'vdfhgfhgh', '', ' 4545.00', ' 4545.00'),
(8, 2, 'sds', '12/07/2015', 'dsd', '30', 'PC Express Computer Supplies', '3434.00', 'cvcbvbvb', '', ' 3434.00', ' 3434.00'),
(9, 2, 's434', '12/08/2015', '35435456565656', '60', 'PC Express Computer Supplies', '3.00', 'vdfhgfhgh', '', ' 6.00', '  0'),
(10, 2, '32222', '12/08/2015', 'dfd', '30', 'PC Express Computer Supplies', '5.00', 'ghgh', '', ' 10.00', ' 10.00'),
(11, 2, 'sdsd', '12/07/2015', '45454', '60', 'PC Express Computer Supplies', '4.00', 'vv', '', ' 8.00', '0.00'),
(12, 2, '33333443546', '01/06/2016', 'wr465', '30', 'PC Express Computer Supplies', '455.00', 'fdfdf', '', ' 10.00', '  0'),
(13, 2, '5', '12/23/2015', 'd', '60', 'PC Express Computer Supplies', '4.00', 'v', '', ' 8.00', '  0'),
(14, 2, '434343', '12/23/2015', '46', '60', 'PC Express Computer Supplies', '5.00', 'fgfg', '', ' 10.00', '  0'),
(15, 2, '4', '12/09/2015', '7', '60', 'PC Express Computer Supplies', '5.00', 'df', '', ' 10.00', '  0'),
(16, 2, '111', '12/16/2015', '111', '30', 'PC Express Computer Supplies', '1.00', 'x', '', ' 2.00', '  0'),
(17, 2, 's', '12/15/2015', 's', '15', 'PC Express Computer Supplies', '2.00', '2', '', ' 4.00', ' 4.00'),
(18, 2, '33434543534', '12/03/2015', '465465', '120', 'PC Express Computer Supplies', '454545.00', 'sdfdf', '', ' 908.00', ' 549.00'),
(19, 2, '11111111111111111111', '12/22/2015', 'sfdfdf', '15', 'PC Express Computer Supplies', '454.00', 'dfd', '', ' 90.00', ' 58.00'),
(20, 2, '232323', '12/16/2015', '2', '15', 'PC Express Computer Supplies', '424.00', 'fgbf', '', ' 6.00', ' 36.00'),
(21, 2, '0jjjj', '12/30/2015', 'de', '60', 'PC Express Computer Supplies', '4.00', 'v', '', ' 8.00', '0.00'),
(22, 2, '15-999', '12/24/2015', 'wewe', '60', 'PC Express Computer Supplies', '34.00', 'dfdf', '', ' 34.00', ' 34.00'),
(23, 2, '15-324', '12/08/2015', '34545', '15', 'PC Express Computer Supplies', '454.00', 'dfdf', '', ' 347.00', ' 777.00'),
(24, 2, '12-1212', '12/15/2015', 'dfdf', '30', 'PC Express Computer Supplies', '34324.00', 'dfdf', '', ' 3468.00', ' 68.00'),
(25, 2, '15-0002', '12/23/2015', 'adsdfe', '30', 'PC Express Computer Supplies', '34343.00', 'sfdf', '', ' 68.00', ' 686.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_journal_cd`
--

CREATE TABLE IF NOT EXISTS `tb_journal_cd` (
  `cd_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `cd_date` varchar(255) NOT NULL,
  `cd_voucher_no` varchar(255) NOT NULL,
  `cd_payee_name` varchar(255) NOT NULL,
  `cd_check_no` varchar(255) NOT NULL,
  `cd_master_name` varchar(255) NOT NULL,
  `cd_released` varchar(255) NOT NULL,
  `cd_released_date` varchar(255) NOT NULL,
  `cd_cleared` varchar(255) NOT NULL,
  `cd_cleared_date` varchar(255) NOT NULL,
  `cd_check_amount` varchar(255) NOT NULL,
  `cd_particulars` varchar(255) NOT NULL,
  `cd_amount_words` varchar(255) NOT NULL,
  `cd_trans_id` int(11) NOT NULL,
  `total_debit` varchar(255) NOT NULL,
  `total_credit` varchar(255) NOT NULL,
  PRIMARY KEY (`cd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_journal_cd`
--

INSERT INTO `tb_journal_cd` (`cd_id`, `project_id`, `cd_date`, `cd_voucher_no`, `cd_payee_name`, `cd_check_no`, `cd_master_name`, `cd_released`, `cd_released_date`, `cd_cleared`, `cd_cleared_date`, `cd_check_amount`, `cd_particulars`, `cd_amount_words`, `cd_trans_id`, `total_debit`, `total_credit`) VALUES
(1, 2, '09/13/2015', '145', 'Mich', '156', 'Cash in Bank - BDO San Juan', 'Yes', '', 'Yes', '', '12000.00', 'To check cash', '', 0, ' 12000.00', ' 12000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_journal_cr`
--

CREATE TABLE IF NOT EXISTS `tb_journal_cr` (
  `cr_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `cr_or_no` varchar(255) NOT NULL,
  `cr_or_date` varchar(255) NOT NULL,
  `cr_master_name_customer` varchar(255) NOT NULL,
  `cr_sj_si_no` varchar(255) NOT NULL,
  `cr_master_name_bank` varchar(255) NOT NULL,
  `cr_cleared` varchar(255) NOT NULL,
  `cr_cleared_date` varchar(255) NOT NULL,
  `cr_or_amount` varchar(255) NOT NULL,
  `cr_particulars` varchar(255) NOT NULL,
  `cr_trans_id` int(11) NOT NULL,
  `total_debit` varchar(255) NOT NULL,
  `total_credit` varchar(255) NOT NULL,
  PRIMARY KEY (`cr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_journal_cr`
--

INSERT INTO `tb_journal_cr` (`cr_id`, `project_id`, `cr_or_no`, `cr_or_date`, `cr_master_name_customer`, `cr_sj_si_no`, `cr_master_name_bank`, `cr_cleared`, `cr_cleared_date`, `cr_or_amount`, `cr_particulars`, `cr_trans_id`, `total_debit`, `total_credit`) VALUES
(1, 2, '12', '10/09/2015', 'Sommers Systems', '5654', 'Cash in Bank - Metro Bank Commonwealth', 'Yes', '10/14/2015', '5000.00', 'TO RECORD DATA', 0, ' 5000.00', ' 5000.00'),
(2, 2, '123456789', '12/23/2015', 'Sommers Systems', '1234', 'Cash in Bank - Metro Bank Commonwealth', '', '', '500.00', 'dfsdf', 0, ' 500.00', ' 500.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_journal_gj`
--

CREATE TABLE IF NOT EXISTS `tb_journal_gj` (
  `gj_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` varchar(255) NOT NULL,
  `gj_code` varchar(255) NOT NULL,
  `gj_date` varchar(255) NOT NULL,
  `gj_cleared` varchar(255) NOT NULL,
  `gj_cleared_date` varchar(255) NOT NULL,
  `gj_amount` varchar(255) NOT NULL,
  `gj_particulars` varchar(255) NOT NULL,
  `gj_trans_id` int(11) NOT NULL,
  `total_debit` varchar(255) NOT NULL,
  `total_credit` varchar(255) NOT NULL,
  PRIMARY KEY (`gj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_journal_gj`
--

INSERT INTO `tb_journal_gj` (`gj_id`, `project_id`, `gj_code`, `gj_date`, `gj_cleared`, `gj_cleared_date`, `gj_amount`, `gj_particulars`, `gj_trans_id`, `total_debit`, `total_credit`) VALUES
(1, '2', '15-002-023', '12/02/2015', '', '', '500.00', 'To spmetnig', 0, ' 500.00', ' 500.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_journal_sj`
--

CREATE TABLE IF NOT EXISTS `tb_journal_sj` (
  `sj_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `sj_si_no` varchar(255) NOT NULL,
  `sj_si_date` varchar(255) NOT NULL,
  `sj_master_name` varchar(255) NOT NULL,
  `sj_terms` varchar(255) NOT NULL,
  `sj_si_amount` varchar(255) NOT NULL,
  `sj_particulars` varchar(255) NOT NULL,
  `sj_trans_id` int(11) NOT NULL,
  `total_debit` varchar(255) NOT NULL,
  `total_credit` varchar(255) NOT NULL,
  PRIMARY KEY (`sj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_journal_sj`
--

INSERT INTO `tb_journal_sj` (`sj_id`, `project_id`, `sj_si_no`, `sj_si_date`, `sj_master_name`, `sj_terms`, `sj_si_amount`, `sj_particulars`, `sj_trans_id`, `total_debit`, `total_credit`) VALUES
(1, 2, '1234', '09/01/2015', 'DevCon Inc', '7', '15000.00', 'to record data', 0, ' 15000.00', ' 15000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_journal_trans`
--

CREATE TABLE IF NOT EXISTS `tb_journal_trans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `account_code` varchar(100) NOT NULL,
  `sub_code` varchar(100) NOT NULL,
  `account_name` varchar(225) NOT NULL,
  `trans_dr` varchar(225) NOT NULL,
  `trans_cr` varchar(225) NOT NULL,
  `trans_date` varchar(225) NOT NULL,
  `trans_journal` varchar(225) NOT NULL,
  `account_group` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `tb_journal_trans`
--

INSERT INTO `tb_journal_trans` (`id`, `project_id`, `trans_id`, `account_code`, `sub_code`, `account_name`, `trans_dr`, `trans_cr`, `trans_date`, `trans_journal`, `account_group`) VALUES
(1, 2, 1, '10001', '10001 - 10000', 'Cash in Bank - BDO San Juan', '0.00', '11000.00', '09/10/2015', 'ap', 'test'),
(2, 2, 1, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '11000.00', '0.00', '09/10/2015', 'ap', 'Accounts Payable - Trade'),
(3, 2, 2, '10001', '10001 - 10001', 'Cash in Bank - Metro Bank Commonwealth', '0.00', '11000.00', '09/10/2015', 'ap', 'test'),
(4, 2, 2, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '11000.00', '0.00', '09/10/2015', 'ap', 'Accounts Payable - Trade'),
(5, 2, 3, '10001', '10001 - 10003', 'Cash in Bank - China Bank Regalado', '0.00', '11000.00', '09/10/2015', 'ap', 'test'),
(6, 2, 3, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '11000.00', '0.00', '09/10/2015', 'ap', 'Accounts Payable - Trade'),
(7, 2, 4, '10001', '10001 - 10001', 'Cash in Bank - Metro Bank Commonwealth', '0.00', '21000.00', '09/09/2015', 'ap', 'test'),
(8, 2, 4, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '21000.00', '0.00', '09/09/2015', 'ap', 'Accounts Payable - Trade'),
(9, 2, 5, '10001', '10001 - 10001', 'Cash in Bank - Metro Bank Commonwealth', '0.00', '3000.00', '09/10/2015', 'ap', 'test'),
(10, 2, 5, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '3000.00', '0.00', '09/10/2015', 'ap', 'Accounts Payable - Trade'),
(11, 2, 6, '10001', '10001 - 10001', 'Cash in Bank - Metro Bank Commonwealth', '0.00', '900.00', '09/10/2015', 'ap', 'test'),
(12, 2, 6, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '900.00', '0.00', '09/10/2015', 'ap', 'Accounts Payable - Trade'),
(13, 2, 1, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '12000.00', '0.00', '09/13/2015', 'cd', 'Accounts Payable - Trade'),
(14, 2, 1, '10001', '10001 - 10000', 'Cash in Bank - BDO San Juan', '0.00', '12000.00', '09/13/2015', 'cd', 'test'),
(15, 2, 1, '40001', '40001 - 00002', 'Accounts Receivable Trade - DevCon Inc', '15000.00', '0.00', '09/01/2015', 'sj', 'test'),
(16, 2, 1, '40004', '40004 - 40002', 'Sales Revenue - DevCon Inc', '0.00', '15000.00', '09/01/2015', 'sj', 'test'),
(17, 2, 1, '40001', '40001 - 00001', 'Accounts Receivable Trade - Sommers Systems', '0', '5000.00', '10/09/2015', 'cr', 'test'),
(18, 2, 1, '10001', '10001 - 10001', 'Cash in Bank - Metro Bank Commonwealth', '5000.00', '0.00', '10/09/2015', 'cr', 'test'),
(19, 2, 7, '50001', '50001', ' Office Supplies ', '4545.00', '0.00', '11/29/2015', 'ap', 'test'),
(20, 2, 7, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '0.00', '4545.00', '11/29/2015', 'ap', 'Accounts Payable - Trade'),
(21, 2, 8, '50001', '50001', ' Office Supplies ', '3434.00', '0.00', '12/07/2015', 'ap', 'test'),
(22, 2, 8, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '0.00', '3434.00', '12/07/2015', 'ap', 'Accounts Payable - Trade'),
(23, 2, 9, '50001', '50001', ' Office Supplies ', '3.00', '3.00', '12/08/2015', 'ap', 'test'),
(24, 2, 9, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '3.00', '3.00', '12/08/2015', 'ap', 'Accounts Payable - Trade'),
(25, 2, 10, '50001', '50001', ' Office Supplies ', '5.00', '5.00', '12/08/2015', 'ap', 'test'),
(26, 2, 10, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '5.00', '5.00', '12/08/2015', 'ap', 'Accounts Payable - Trade'),
(27, 2, 11, '50001', '50001', ' Office Supplies ', '4.00', '4.00', '12/07/2015', 'ap', 'test'),
(28, 2, 11, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '4.00', '4.00', '12/07/2015', 'ap', 'Accounts Payable - Trade'),
(29, 2, 12, '50001', '50001', ' Office Supplies ', '5.00', '5.00', '01/06/2016', 'ap', 'test'),
(30, 2, 12, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '5.00', '5.00', '01/06/2016', 'ap', 'Accounts Payable - Trade'),
(31, 2, 13, '50001', '50001', ' Office Supplies ', '4.00', '4.00', '12/23/2015', 'ap', 'test'),
(32, 2, 13, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '4.00', '4.00', '12/23/2015', 'ap', 'Accounts Payable - Trade'),
(33, 2, 14, '50001', '50001', ' Office Supplies ', '5.00', '5.00', '12/23/2015', 'ap', 'test'),
(34, 2, 14, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '5.00', '5.00', '12/23/2015', 'ap', 'Accounts Payable - Trade'),
(35, 2, 15, '50001', '50001', ' Office Supplies ', '5.00', '5.00', '12/09/2015', 'ap', 'test'),
(36, 2, 15, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '5.00', '5.00', '12/09/2015', 'ap', 'Accounts Payable - Trade'),
(37, 2, 16, '50001', '50001', ' Office Supplies ', '1.00', '1.00', '12/16/2015', 'ap', 'test'),
(38, 2, 16, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '1.00', '1.00', '12/16/2015', 'ap', 'Accounts Payable - Trade'),
(39, 2, 17, '50001', '50001', ' Office Supplies ', '2.00', '2.00', '12/15/2015', 'ap', 'test'),
(40, 2, 17, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '2.00', '2.00', '12/15/2015', 'ap', 'Accounts Payable - Trade'),
(41, 2, 18, '50002', '50002', ' Programmers System Unit Maintenance ', '454.00', '545.00', '12/03/2015', 'ap', 'test'),
(42, 2, 18, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '454.00', '45.00', '12/03/2015', 'ap', 'Accounts Payable - Trade'),
(43, 2, 19, '50001', '50001', ' Office Supplies ', '45.00', '4.00', '12/22/2015', 'ap', 'test'),
(44, 2, 19, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '45.00', '54.00', '12/22/2015', 'ap', 'Accounts Payable - Trade'),
(45, 2, 20, '50002', '50002', ' Programmers System Unit Maintenance ', '3.00', '3.00', '12/16/2015', 'ap', 'test'),
(46, 2, 20, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '3.00', '33.00', '12/16/2015', 'ap', 'Accounts Payable - Trade'),
(47, 2, 21, '50002', '50002', ' Programmers System Unit Maintenance ', '4.00', '4.00', '12/30/2015', 'ap', 'test'),
(48, 2, 21, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '4.00', '4.00', '12/30/2015', 'ap', 'Accounts Payable - Trade'),
(49, 2, 22, '50001', '50001', ' Office Supplies ', '34.00', '0.00', '12/24/2015', 'ap', 'test'),
(50, 2, 22, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '0.00', '34.00', '12/24/2015', 'ap', 'Accounts Payable - Trade'),
(51, 2, 23, '50002', '50002', ' Programmers System Unit Maintenance ', '4.00', '434.00', '12/08/2015', 'ap', 'test'),
(52, 2, 23, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '343.00', '343.00', '12/08/2015', 'ap', 'Accounts Payable - Trade'),
(53, 2, 24, '50002', '50002', ' Programmers System Unit Maintenance ', '3434.00', '34.00', '12/15/2015', 'ap', 'test'),
(54, 2, 24, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '34.00', '34.00', '12/15/2015', 'ap', 'Accounts Payable - Trade'),
(55, 2, 25, '50001', '50001', ' Office Supplies ', '34.00', '343.00', '12/23/2015', 'ap', 'test'),
(56, 2, 25, '20001', '20001 - 00003', 'Accounts Payable Trade - PC Express Computer Supplies', '34.00', '343.00', '12/23/2015', 'ap', 'Accounts Payable - Trade'),
(57, 2, 2, '10001', '10001 - 10001', 'Cash in Bank - Metro Bank Commonwealth', '500.00', '0.00', '12/23/2015', 'cr', 'test'),
(58, 2, 2, '40001', '40001 - 00001', 'Accounts Receivable Trade - Sommers Systems', '0.00', '500.00', '12/23/2015', 'cr', 'test'),
(59, 2, 1, '40001', '40001 - 00002', 'Accounts Receivable Trade - DevCon Inc', '500.00', '0.00', '12/02/2015', 'gj', 'test'),
(60, 2, 1, '40001', '40001 - 00001', 'Accounts Receivable Trade - Sommers Systems', '0.00', '500.00', '12/02/2015', 'gj', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tb_master`
--

CREATE TABLE IF NOT EXISTS `tb_master` (
  `master_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `master_code` varchar(255) NOT NULL,
  `master_date` varchar(255) NOT NULL,
  `master_name` varchar(255) NOT NULL,
  `master_add` varchar(255) NOT NULL,
  `master_type` varchar(255) NOT NULL,
  `master_terms_payment` varchar(255) NOT NULL,
  `master_contact_person` varchar(255) NOT NULL,
  `master_position` varchar(255) NOT NULL,
  `master_tel_no` varchar(255) NOT NULL,
  `master_fax_no` varchar(255) NOT NULL,
  `master_email` varchar(255) NOT NULL,
  PRIMARY KEY (`master_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_master`
--

INSERT INTO `tb_master` (`master_id`, `project_id`, `master_code`, `master_date`, `master_name`, `master_add`, `master_type`, `master_terms_payment`, `master_contact_person`, `master_position`, `master_tel_no`, `master_fax_no`, `master_email`) VALUES
(1, 2, '00001', '08/22/2015', 'Sommers Systems', 'Oritgas', 'Customer', '30', 'Den Topasi', 'Web Developer', '8976513', '91726728', 'den@gmail.com'),
(2, 2, '00002', '08/23/2015', 'DevCon Inc', 'Makati City', 'Customer', '60', 'Mark Lavapie', 'Senior Web Developer', '6158172', '722781981', 'mark@gmail.com'),
(3, 2, '00003', '08/22/2015', 'PC Express Computer Supplies', 'San Juan Green Hills', 'Supplier', '30', 'Jay Masbad', 'Technical Administrator', '8726018', '7768291', 'jay.masbad@gmail.com'),
(4, 2, '00004', '08/23/2015', 'Asticom Manpower Agency', 'Boni Ave. Mandaluyong City', 'Employee', '30', 'Miguel Santos', 'HR Manager', '4572496', '1111223', 'asticommanpower@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_project`
--

CREATE TABLE IF NOT EXISTS `tb_project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(225) NOT NULL,
  `project_location` varchar(225) NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_project`
--

INSERT INTO `tb_project` (`project_id`, `project_name`, `project_location`) VALUES
(1, 'Team Storm', 'EDSA Ortigas'),
(2, 'EPSI', 'Alabang'),
(3, 'PNI BIZ', 'EDSA Ortigas'),
(4, 'PNI International', 'EDSA Ortigas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_recon_history`
--

CREATE TABLE IF NOT EXISTS `tb_recon_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recon_date` varchar(225) NOT NULL,
  `recon_balance` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE IF NOT EXISTS `tb_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_type` varchar(225) NOT NULL,
  `fname` varchar(225) NOT NULL,
  `lname` varchar(225) NOT NULL,
  `uname` varchar(225) NOT NULL,
  `pwd` varchar(225) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `project_id`, `user_type`, `fname`, `lname`, `uname`, `pwd`) VALUES
(1, 1, 'Administrator', 'MHon', 'Romero', 'adminMhon', 'admin'),
(2, 2, 'Administrator', 'Michelle', 'Anne', 'admin', 'admin'),
(3, 2, 'User', 'Mich', 'Cruz', 'chelle', '12'),
(4, 2, 'User', 'MHon', 'Romero', 'admin2', 'admin2'),
(5, 2, 'User', 'dsa', 'dsad', 'dsad', 'dsad');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_access`
--

CREATE TABLE IF NOT EXISTS `tb_user_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tab_transaction` int(11) NOT NULL,
  `tab_ledger` int(11) NOT NULL,
  `tab_report` int(11) NOT NULL,
  `tab_admin` int(11) NOT NULL,
  `tab_setup` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_user_access`
--

INSERT INTO `tb_user_access` (`id`, `user_id`, `tab_transaction`, `tab_ledger`, `tab_report`, `tab_admin`, `tab_setup`) VALUES
(1, 2, 1, 1, 1, 1, 1),
(2, 4, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_type`
--

CREATE TABLE IF NOT EXISTS `tb_user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userType` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_user_type`
--

INSERT INTO `tb_user_type` (`id`, `userType`) VALUES
(1, 'Administrator'),
(2, 'Accounting Staff'),
(3, 'Auditor Staff'),
(4, 'User');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
