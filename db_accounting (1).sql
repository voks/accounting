-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2015 at 08:04 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

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
`id` int(11) NOT NULL,
  `account_type` varchar(225) NOT NULL,
  `account_groupname` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

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
`sub_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `sub_date` varchar(255) NOT NULL,
  `account_code` int(11) NOT NULL,
  `account_title` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `sub_code` varchar(255) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `master_link` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

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
`account_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `account_date` varchar(255) NOT NULL,
  `account_code` varchar(255) NOT NULL,
  `account_title` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `account_group` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

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
-- Table structure for table `tb_bank_recon`
--

CREATE TABLE IF NOT EXISTS `tb_bank_recon` (
`bank_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_month` varchar(255) NOT NULL,
  `bank_year` varchar(255) NOT NULL,
  `bank_balance` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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
`id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `footer` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
`ap_id` int(11) NOT NULL,
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
  `total_credit` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_journal_ap`
--

INSERT INTO `tb_journal_ap` (`ap_id`, `project_id`, `ap_invoice_no`, `ap_invoice_date`, `ap_po_no`, `ap_terms`, `ap_master_name`, `ap_invoice_amount`, `ap_particulars`, `ap_trans_id`, `total_debit`, `total_credit`) VALUES
(1, 2, '123', '09/10/2015', '123', '7', 'PC Express Computer Supplies', '11000.00', 'To record computer', '', ' 11000.00', ' 11000.00'),
(2, 2, '1234', '09/10/2015', '1234', '7', 'PC Express Computer Supplies', '11000.00', 'To reocord PC', '', '11000.00', ' 11000.00'),
(3, 2, '12345', '09/10/2015', '12345', '7', 'PC Express Computer Supplies', '11000.00', 'To record PC', '', '11000.00', '11000.00'),
(4, 2, '1224', '09/09/2015', '1224', '30', 'PC Express Computer Supplies', '21000.00', 'to record pc', '', ' 21000.00', ' 21000.00'),
(5, 2, '2234', '09/10/2015', '2234', '15', 'PC Express Computer Supplies', '3000.00', 'To Record PC', '', ' 3000.00', ' 3000.00'),
(6, 2, '3324', '09/10/2015', '3324', '7', 'PC Express Computer Supplies', '900.00', 'To record', '', ' 900.00', ' 900.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_journal_cd`
--

CREATE TABLE IF NOT EXISTS `tb_journal_cd` (
`cd_id` int(11) NOT NULL,
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
  `total_credit` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
`cr_id` int(11) NOT NULL,
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
  `total_credit` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_journal_cr`
--

INSERT INTO `tb_journal_cr` (`cr_id`, `project_id`, `cr_or_no`, `cr_or_date`, `cr_master_name_customer`, `cr_sj_si_no`, `cr_master_name_bank`, `cr_cleared`, `cr_cleared_date`, `cr_or_amount`, `cr_particulars`, `cr_trans_id`, `total_debit`, `total_credit`) VALUES
(1, 2, '12', '10/09/2015', 'Sommers Systems', '5654', 'Cash in Bank - Metro Bank Commonwealth', 'Yes', '10/14/2015', '5000.00', 'TO RECORD DATA', 0, ' 5000.00', ' 5000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_journal_gj`
--

CREATE TABLE IF NOT EXISTS `tb_journal_gj` (
`gj_id` int(11) NOT NULL,
  `project_id` varchar(255) NOT NULL,
  `gj_code` varchar(255) NOT NULL,
  `gj_date` varchar(255) NOT NULL,
  `gj_cleared` varchar(255) NOT NULL,
  `gj_cleared_date` varchar(255) NOT NULL,
  `gj_amount` varchar(255) NOT NULL,
  `gj_particulars` varchar(255) NOT NULL,
  `gj_trans_id` int(11) NOT NULL,
  `total_debit` varchar(255) NOT NULL,
  `total_credit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_journal_sj`
--

CREATE TABLE IF NOT EXISTS `tb_journal_sj` (
`sj_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `sj_si_no` varchar(255) NOT NULL,
  `sj_si_date` varchar(255) NOT NULL,
  `sj_master_name` varchar(255) NOT NULL,
  `sj_terms` varchar(255) NOT NULL,
  `sj_si_amount` varchar(255) NOT NULL,
  `sj_particulars` varchar(255) NOT NULL,
  `sj_trans_id` int(11) NOT NULL,
  `total_debit` varchar(255) NOT NULL,
  `total_credit` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
`id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `account_code` varchar(100) NOT NULL,
  `sub_code` varchar(100) NOT NULL,
  `account_name` varchar(225) NOT NULL,
  `trans_dr` varchar(225) NOT NULL,
  `trans_cr` varchar(225) NOT NULL,
  `trans_date` varchar(225) NOT NULL,
  `trans_journal` varchar(225) NOT NULL,
  `account_group` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

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
(18, 2, 1, '10001', '10001 - 10001', 'Cash in Bank - Metro Bank Commonwealth', '5000.00', '0.00', '10/09/2015', 'cr', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tb_master`
--

CREATE TABLE IF NOT EXISTS `tb_master` (
`master_id` int(11) NOT NULL,
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
  `master_email` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
`project_id` int(11) NOT NULL,
  `project_name` varchar(225) NOT NULL,
  `project_location` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
`id` int(11) NOT NULL,
  `recon_date` varchar(225) NOT NULL,
  `recon_balance` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE IF NOT EXISTS `tb_users` (
`user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_type` varchar(225) NOT NULL,
  `fname` varchar(225) NOT NULL,
  `lname` varchar(225) NOT NULL,
  `uname` varchar(225) NOT NULL,
  `pwd` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tab_transaction` int(11) NOT NULL,
  `tab_ledger` int(11) NOT NULL,
  `tab_report` int(11) NOT NULL,
  `tab_admin` int(11) NOT NULL,
  `tab_setup` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
`id` int(11) NOT NULL,
  `userType` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user_type`
--

INSERT INTO `tb_user_type` (`id`, `userType`) VALUES
(1, 'Administrator'),
(2, 'Accounting Staff'),
(3, 'Auditor Staff'),
(4, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_account_groups`
--
ALTER TABLE `tb_account_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_account_subsidiary`
--
ALTER TABLE `tb_account_subsidiary`
 ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `tb_account_title`
--
ALTER TABLE `tb_account_title`
 ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `tb_bank_recon`
--
ALTER TABLE `tb_bank_recon`
 ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `tb_copyrights`
--
ALTER TABLE `tb_copyrights`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_journal_ap`
--
ALTER TABLE `tb_journal_ap`
 ADD PRIMARY KEY (`ap_id`);

--
-- Indexes for table `tb_journal_cd`
--
ALTER TABLE `tb_journal_cd`
 ADD PRIMARY KEY (`cd_id`);

--
-- Indexes for table `tb_journal_cr`
--
ALTER TABLE `tb_journal_cr`
 ADD PRIMARY KEY (`cr_id`);

--
-- Indexes for table `tb_journal_gj`
--
ALTER TABLE `tb_journal_gj`
 ADD PRIMARY KEY (`gj_id`);

--
-- Indexes for table `tb_journal_sj`
--
ALTER TABLE `tb_journal_sj`
 ADD PRIMARY KEY (`sj_id`);

--
-- Indexes for table `tb_journal_trans`
--
ALTER TABLE `tb_journal_trans`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_master`
--
ALTER TABLE `tb_master`
 ADD PRIMARY KEY (`master_id`);

--
-- Indexes for table `tb_project`
--
ALTER TABLE `tb_project`
 ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `tb_recon_history`
--
ALTER TABLE `tb_recon_history`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tb_user_access`
--
ALTER TABLE `tb_user_access`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user_type`
--
ALTER TABLE `tb_user_type`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_account_groups`
--
ALTER TABLE `tb_account_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `tb_account_subsidiary`
--
ALTER TABLE `tb_account_subsidiary`
MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_account_title`
--
ALTER TABLE `tb_account_title`
MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_bank_recon`
--
ALTER TABLE `tb_bank_recon`
MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_copyrights`
--
ALTER TABLE `tb_copyrights`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_journal_ap`
--
ALTER TABLE `tb_journal_ap`
MODIFY `ap_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_journal_cd`
--
ALTER TABLE `tb_journal_cd`
MODIFY `cd_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_journal_cr`
--
ALTER TABLE `tb_journal_cr`
MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_journal_gj`
--
ALTER TABLE `tb_journal_gj`
MODIFY `gj_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_journal_sj`
--
ALTER TABLE `tb_journal_sj`
MODIFY `sj_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_journal_trans`
--
ALTER TABLE `tb_journal_trans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tb_master`
--
ALTER TABLE `tb_master`
MODIFY `master_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_project`
--
ALTER TABLE `tb_project`
MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_recon_history`
--
ALTER TABLE `tb_recon_history`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_user_access`
--
ALTER TABLE `tb_user_access`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_user_type`
--
ALTER TABLE `tb_user_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
