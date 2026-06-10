-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 10, 2026 at 05:06 PM
-- Server version: 5.7.44
-- PHP Version: 8.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuhsa_dird`
--

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

DROP TABLE IF EXISTS `beneficiaries`;
CREATE TABLE IF NOT EXISTS `beneficiaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grant_type` enum('IBR','NRF') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'IBR',
  `grant_year` year(4) NOT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `project_title` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `progress` enum('Ongoing','Completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ongoing',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`id`, `full_name`, `department`, `faculty`, `grant_type`, `grant_year`, `amount`, `project_title`, `progress`, `created_at`) VALUES
(111, 'Dr. Iliyasu Ibrahim AA', 'Nutrition and Dietetics', '', 'IBR', '2023', 0.00, 'Comparison of soybean and bambara nuts-augmented cassava flour and enhanced value assessment', 'Ongoing', '2026-06-10 16:33:21'),
(112, 'Dr. Badamasi Ibrahim', 'Anatomy', '', 'IBR', '2023', 0.00, '', 'Ongoing', '2026-06-10 16:33:21'),
(113, 'Prof. Musa A Garbati', 'Internal Medicine', '', 'IBR', '2023', 0.00, 'Quapdruple tragedy: Quadruple Tragedy: Substance Abuse and The Scourge of HIV, Hepatitis B and Hepatitis C Infections In Federal University Of Health Sciences, Azare, Northeastern Nigeria', 'Ongoing', '2026-06-10 16:33:21'),
(114, 'Dr Saddiq Abubakar Dalhatu', 'Physics', '', 'IBR', '2023', 0.00, 'Radiological Hazard Assessment of natural Radionuclides in Soil Samples in Quarry area in Shira, Bauchi State, Nigeria', 'Ongoing', '2026-06-10 16:33:21'),
(115, 'Dahiru dahuwa', 'Physics', '', 'IBR', '2023', 0.00, 'Quantitative Evaluation Of Radiological Risks In Soil And Soil To Millet Radionuclide Transfer: Implications For Life Time Cancer Risk In Azare, Bauchi State, Nigeria', 'Ongoing', '2026-06-10 16:33:21'),
(116, 'Prof. bala Mohammed Audu', 'Obstetrics and Gynaecology', '', 'IBR', '2023', 0.00, 'Multi Genomic Evaluation of in women with endometrial cancer: a comparison of women in Nigeria, the carribean and the United States', 'Ongoing', '2026-06-10 16:33:21'),
(117, 'Muhammed Mukhtar Sani', 'Chemistry', '', 'IBR', '2023', 0.00, 'Complexation behaviours and biological activity of some mixed loigand complexes of cephalosporins', 'Ongoing', '2026-06-10 16:33:21'),
(118, 'Uchenna Ezenkwa', 'Pathology', '', 'IBR', '2023', 0.00, 'Interventional Research to eliminate Cervical cancer as a public health problem', 'Ongoing', '2026-06-10 16:33:21'),
(119, 'Dr. Mairo Usman Kadaura', 'Medical Microbiology', '', 'IBR', '2023', 0.00, 'Prevalence and susceptibility patterns of Gram Negative uropathogens among adult patients attending Federal Medical Centre, Azare, Bauchi State', 'Ongoing', '2026-06-10 16:33:21'),
(120, 'Dr. Alkali Mohammed', 'Internal Medicine', '', 'IBR', '2023', 0.00, 'Evaluation of ascitic fluid absolute polymorphonuclear cell count as a surrogate marker for spntaneous bacterial peritonitis in patients with liver cirrhosisin Northeast Nigeria', 'Ongoing', '2026-06-10 16:33:21'),
(121, 'Habib Sa&#039;ad', 'Radiography', '', 'IBR', '2023', 0.00, 'Assessment of entrance skin dose and radiation protection of paediatric patients in some selected hospital in Northeastern Nigeria', 'Ongoing', '2026-06-10 16:33:21'),
(122, 'Prof. Babagana Kolo', 'Chemistry', '', 'IBR', '2023', 0.00, 'Assessment of some heavy metals and pesticides in soil water', 'Ongoing', '2026-06-10 16:33:21'),
(123, 'Dr. Adamu Auwal', 'Ear Nose and Throat', '', 'IBR', '2023', 0.00, 'Pure tone audiometry evaluation of hearing impairment among diabetic patients in Azare', 'Ongoing', '2026-06-10 16:33:21'),
(124, 'Ibrahim Mohammed Sani', 'Nutrition and Dietetics', '', 'IBR', '2023', 0.00, 'Fortification of Sabdarifia and Doum palm with Moringa leaves', 'Ongoing', '2026-06-10 16:33:21'),
(125, 'Dr. Fatima Sule Mohammed', 'Nutrition and Dietetics', '', 'IBR', '2023', 0.00, 'Production of enhanced and assorted Miyan kuka (baobab leave soup) powder', 'Ongoing', '2026-06-10 16:33:21'),
(126, 'Yahaya Bappa Suleiman', 'Radiography', '', 'IBR', '2023', 0.00, 'Assessment of anamia-induced tropical splenomegaly using radio-haematological indices', 'Ongoing', '2026-06-10 16:33:21'),
(127, 'Hussaini Ahmed', 'Radiography', '', 'IBR', '2023', 0.00, 'Patient radiation safety in interventional X-Ray using artificial intelligence', 'Ongoing', '2026-06-10 16:33:21'),
(128, 'Dr. Abubakar Jibril', 'Medical Microbiology', '', 'IBR', '2023', 0.00, 'Detection of Quinolone-resistant enterobacterales among patients with urinary tract infection', 'Ongoing', '2026-06-10 16:33:21'),
(129, 'Adamu Mohammed Sabo', 'Nursing Sciences', '', 'IBR', '2023', 0.00, 'Determination of the relationship between age, gender, occupation, level of education, length of stay in IDP camps and post traumatic stress disorder (PTSD) among IDPs in Borno State, Nigeria', 'Ongoing', '2026-06-10 16:33:21'),
(130, 'Dr. Sabiu Aminu', 'Chemical Pathology', '', 'IBR', '2023', 0.00, 'Evaluation of oxidative stress markers and antioxidant vitamins among patients with pulmonary tuberculosis in Aminu Kano Teaching Hospital (AKTH), Kano State, Nigeria', 'Ongoing', '2026-06-10 16:33:21'),
(131, 'Dr. Ali Mohammed Baba', 'Mathematical Science', '', 'IBR', '2023', 0.00, 'Interpretation of high resolution aeromagnetic data and Landsat imaginary of younger granite province in and around Tafawa Balewa Area of Bauchi State, northeatern Nigeria', 'Ongoing', '2026-06-10 16:33:21'),
(132, 'Mohammed Abdullahi Abdullahi', 'Chemistry', '', 'IBR', '2023', 0.00, 'Biological investogation and chemical constituents of Croton Nigritanus', 'Ongoing', '2026-06-10 16:33:21'),
(133, 'Adamu Alhaji', 'Nursing sciences', '', 'IBR', '2023', 0.00, 'Assessment of relationship between emotional intelligence and conflict resolution among nurse Managers at Tertiary Health Institutions of North Easter State of Nigeria', 'Ongoing', '2026-06-10 16:33:21'),
(134, 'Prof. Calvin Chama', 'Obsterics and gynaecology', '', 'IBR', '2023', 0.00, 'Impact of decision-delivery interval on Feto-Maternal outcome in abruptio placentae', 'Ongoing', '2026-06-10 16:33:21'),
(135, 'Prof. Hamma Sabo', 'Mathematical sciences', '', 'IBR', '2023', 0.00, 'Application of markove process modelling in predicting blood sugar level among pre-diabetics &amp; diabetics patients at hospial setting', 'Ongoing', '2026-06-10 16:33:21'),
(136, 'Dr. Sabiu Bala Soja', '', '', 'IBR', '2023', 0.00, 'Exploring the Impacts of Climate-Change-Simulated Heat and IDP-Camp Dynamics on Foetal Circadian System Development in Experimental Rats', 'Ongoing', '2026-06-10 16:33:21'),
(137, 'Dr. Aishatu Yusha&#039;u Armiya&#039;u', 'Psychiatry', '', 'IBR', '2023', 0.00, 'Mental Disorders and Treatment Satisfaction in Oncology; A focus on Northeastern Nigeria', 'Ongoing', '2026-06-10 16:33:21'),
(138, 'Musa Maijidda Abubakar', 'Physiology', '', 'IBR', '2023', 0.00, 'Anti Cancer effect of Ethanol extract of Alcalypha Wilkesiana Leaf on Human Cervical Cancer (HeLa) Cell line', 'Ongoing', '2026-06-10 16:33:21'),
(139, 'Yusuf Olalekan Ahmed', 'Clinical pharmacology', '', 'IBR', '2023', 0.00, 'Modulation of cytochrome P450 and UGT1A1 by Jatropha curcas extracts: implications on pharmacokinetics of dolutegravir', 'Ongoing', '2026-06-10 16:33:21'),
(140, 'Dr. Nasir Garba Zango', 'Medical microbiology', '', 'IBR', '2023', 0.00, 'Assessment of urinary tract infection-related Acute Kidney injury among patients in Maiduguri, North-eastern Nigeria', 'Ongoing', '2026-06-10 16:33:21'),
(141, 'Alhaji Adamu Madara', 'Biology', '', 'IBR', '2023', 0.00, 'Evaluation of Anti-plasmodial activity of ethanolic stem bark extract of piliostigma thonningii schum. (Caesalpiniacea) in mice infected with plasmodium berghei berghei NK 65', 'Ongoing', '2026-06-10 16:33:21'),
(142, 'Abba Mohammed Rabiu', 'Human Anatomy', '', 'IBR', '2023', 0.00, 'Elucidating the role of Vitamin D on the Hypothalamic-Amygdalar-Cortical pathway following recurrent heat-waves and refugee camp stress in primiparous Rats', 'Ongoing', '2026-06-10 16:33:21'),
(143, 'Hussaini Yusuf Mailabari', 'Human Physiology', '', 'IBR', '2023', 0.00, 'Evaluation of Anti-Diabetic potential of Leptadenia Hastata Leaf extract in Rat model of Type 2 Diabetes Mellitus', 'Ongoing', '2026-06-10 16:33:21'),
(144, 'Ahmad Najib Suleiman', 'Chemistry', '', 'IBR', '2023', 0.00, 'Development and optimization of Biopolymer Chitosan-Pla-Based Transdermal Patch for conrolled release of Naproxen: Advancing pain management with enhance drug delivery', 'Ongoing', '2026-06-10 16:33:21'),
(145, 'Salim Aminu', 'Biology', '', 'IBR', '2023', 0.00, 'Molecular epidemiology of urinary schistomosomiasis among individuals residing in Riparian areas of Bauchi State', 'Ongoing', '2026-06-10 16:33:21'),
(146, 'Dr. Nazeef Mohammed', 'Community Medicine', '', 'IBR', '2023', 0.00, 'Assessment of Prevalence, Identification of Risk Factors and Evaluation of the Impact of Postpartum Depression on Maternal Health within Primary Healthcare Settings in Bauchi State', 'Ongoing', '2026-06-10 16:33:21'),
(147, 'Dr. Ibrahim Kurba Ibrahim', 'Human Physiology', '', 'IBR', '2023', 0.00, 'Elucidating Hepato-Pancreatic Toxic Effects of selected classes of Antibiotics on Male Wister Rats', 'Ongoing', '2026-06-10 16:33:21'),
(148, 'Sajida Lawan Bala', 'Medical Radiography', '', 'IBR', '2023', 0.00, 'Cervical cancer screening: Application of ultrasound in early prediction of cervical cancer', 'Ongoing', '2026-06-10 16:33:21'),
(149, 'Mudassir Sidi Musa', 'Medical Radiography', '', 'IBR', '2023', 0.00, 'Assessment of radiation dose to the lens of eye and thyroid of patients undergoing head computed tomography [CT] in Federal Medical Center Azare', 'Ongoing', '2026-06-10 16:33:21'),
(150, 'Rufai Yunusa', 'Histopathology', '', 'IBR', '2023', 0.00, 'Assessment of pattern of expression of oestrogen and progesterone receptors in ovarian carcinoma: A 10 year retrospective study in Aminu Kano teaching hospital', 'Ongoing', '2026-06-10 16:33:21'),
(151, 'Auwalu Mohammed', 'Mathematical sciences', '', 'IBR', '2023', 0.00, 'Analysis of disease and impact of treament using markov process modelling in patients with prostate cancer', 'Ongoing', '2026-06-10 16:33:21'),
(152, 'Aisha Mustapha', 'Biology', '', 'IBR', '2023', 0.00, 'Effects of pesticides on germination of selected crops obtained from the market in Bauchi metropolis', 'Ongoing', '2026-06-10 16:33:21'),
(153, 'Safiya Abuakar Bello', 'Biology', '', 'IBR', '2023', 0.00, 'Antischistosomal effects of annona senegalensis persoon[Annonaceae] [Gwandan  daji] leaves and stem bark extracts against schistomosa species', 'Ongoing', '2026-06-10 16:33:21'),
(154, 'Aishatu Aliyu Shehu', 'Chemistry', '', 'IBR', '2023', 0.00, 'Comparative analysis on cyanide and heavy metal levels in different varieties of cassava cultivated in katagum local government of Bauchi state', 'Ongoing', '2026-06-10 16:33:21'),
(155, 'Ibrahim Salihu', 'Nutrition and dietetics', '', 'IBR', '2023', 0.00, 'Evaluation of Mineral and Phytonutrient Profiles of Cereal-Based Tuwo commonly consumed in Matsango-Azare, Katagum Local Government Area of Bauchi State', 'Ongoing', '2026-06-10 16:33:21'),
(156, 'Aliyu Bello', 'Nutrition and dietetics', '', 'IBR', '2023', 0.00, 'Effects of cassava mill effluent on soil micro-organisms', 'Ongoing', '2026-06-10 16:33:21'),
(157, 'Muhammed Umar Giade', 'Chemistry', '', 'IBR', '2023', 0.00, 'Biogas production and evaluation using rice husk and cow dung from Katagum local government of Bauchi State', 'Ongoing', '2026-06-10 16:33:21'),
(158, 'Munkaila Abdulkarim', 'Nutrition and dietetics', '', 'IBR', '2023', 0.00, 'Effects of mycotoxins on nutritional qualities of some varieties of sorghum in Bauchi state, Nigeria', 'Ongoing', '2026-06-10 16:33:21'),
(159, 'Leah Tari Samuel', 'Biology', '', 'IBR', '2023', 0.00, 'Isolation and identification of bacteria associated with non-alcoholic local drinks sold in Azare, Bauchi State', 'Ongoing', '2026-06-10 16:33:21'),
(160, 'Baba Fugu Mohammed', 'Chemistry', '', 'IBR', '2023', 0.00, 'Some Amino subtituted phenylhdroxamic acid ligand systems as potential antibiotics: Synthesis, structural characterization, antimicrobial activities and In-silico molecular docking', 'Ongoing', '2026-06-10 16:33:21'),
(161, 'Prof. Mohammed Bukar', 'Gynae-oncology', '', 'IBR', '2023', 0.00, 'Correlation between power doppler findings on ultrasound scan and cytology in detecting preinvasive lesions of the cervix', 'Ongoing', '2026-06-10 16:33:21'),
(162, 'Dr. Iliyasu Ibrahim AA', 'Nutrition and Dietetics', '', 'IBR', '2023', 0.00, 'Comparison of soybean and bambara nuts-augmented cassava flour and enhanced value assessment', 'Ongoing', '2026-06-10 16:33:26'),
(163, 'Dr. Badamasi Ibrahim', 'Anatomy', '', 'IBR', '2023', 0.00, '', 'Ongoing', '2026-06-10 16:33:26'),
(164, 'Prof. Musa A Garbati', 'Internal Medicine', '', 'IBR', '2023', 0.00, 'Quapdruple tragedy: Quadruple Tragedy: Substance Abuse and The Scourge of HIV, Hepatitis B and Hepatitis C Infections In Federal University Of Health Sciences, Azare, Northeastern Nigeria', 'Ongoing', '2026-06-10 16:33:26'),
(165, 'Dr Saddiq Abubakar Dalhatu', 'Physics', '', 'IBR', '2023', 0.00, 'Radiological Hazard Assessment of natural Radionuclides in Soil Samples in Quarry area in Shira, Bauchi State, Nigeria', 'Ongoing', '2026-06-10 16:33:26'),
(166, 'Dahiru dahuwa', 'Physics', '', 'IBR', '2023', 0.00, 'Quantitative Evaluation Of Radiological Risks In Soil And Soil To Millet Radionuclide Transfer: Implications For Life Time Cancer Risk In Azare, Bauchi State, Nigeria', 'Ongoing', '2026-06-10 16:33:26'),
(167, 'Prof. bala Mohammed Audu', 'Obstetrics and Gynaecology', '', 'IBR', '2023', 0.00, 'Multi Genomic Evaluation of in women with endometrial cancer: a comparison of women in Nigeria, the carribean and the United States', 'Ongoing', '2026-06-10 16:33:26'),
(168, 'Muhammed Mukhtar Sani', 'Chemistry', '', 'IBR', '2023', 0.00, 'Complexation behaviours and biological activity of some mixed loigand complexes of cephalosporins', 'Ongoing', '2026-06-10 16:33:26'),
(169, 'Uchenna Ezenkwa', 'Pathology', '', 'IBR', '2023', 0.00, 'Interventional Research to eliminate Cervical cancer as a public health problem', 'Ongoing', '2026-06-10 16:33:26'),
(170, 'Dr. Mairo Usman Kadaura', 'Medical Microbiology', '', 'IBR', '2023', 0.00, 'Prevalence and susceptibility patterns of Gram Negative uropathogens among adult patients attending Federal Medical Centre, Azare, Bauchi State', 'Ongoing', '2026-06-10 16:33:26'),
(171, 'Dr. Alkali Mohammed', 'Internal Medicine', '', 'IBR', '2023', 0.00, 'Evaluation of ascitic fluid absolute polymorphonuclear cell count as a surrogate marker for spntaneous bacterial peritonitis in patients with liver cirrhosisin Northeast Nigeria', 'Ongoing', '2026-06-10 16:33:26'),
(172, 'Habib Sa&#039;ad', 'Radiography', '', 'IBR', '2023', 0.00, 'Assessment of entrance skin dose and radiation protection of paediatric patients in some selected hospital in Northeastern Nigeria', 'Ongoing', '2026-06-10 16:33:26'),
(173, 'Prof. Babagana Kolo', 'Chemistry', '', 'IBR', '2023', 0.00, 'Assessment of some heavy metals and pesticides in soil water', 'Ongoing', '2026-06-10 16:33:26'),
(174, 'Dr. Adamu Auwal', 'Ear Nose and Throat', '', 'IBR', '2023', 0.00, 'Pure tone audiometry evaluation of hearing impairment among diabetic patients in Azare', 'Ongoing', '2026-06-10 16:33:26'),
(175, 'Ibrahim Mohammed Sani', 'Nutrition and Dietetics', '', 'IBR', '2023', 0.00, 'Fortification of Sabdarifia and Doum palm with Moringa leaves', 'Ongoing', '2026-06-10 16:33:26'),
(176, 'Dr. Fatima Sule Mohammed', 'Nutrition and Dietetics', '', 'IBR', '2023', 0.00, 'Production of enhanced and assorted Miyan kuka (baobab leave soup) powder', 'Ongoing', '2026-06-10 16:33:26'),
(177, 'Yahaya Bappa Suleiman', 'Radiography', '', 'IBR', '2023', 0.00, 'Assessment of anamia-induced tropical splenomegaly using radio-haematological indices', 'Ongoing', '2026-06-10 16:33:26'),
(178, 'Hussaini Ahmed', 'Radiography', '', 'IBR', '2023', 0.00, 'Patient radiation safety in interventional X-Ray using artificial intelligence', 'Ongoing', '2026-06-10 16:33:26'),
(179, 'Dr. Abubakar Jibril', 'Medical Microbiology', '', 'IBR', '2023', 0.00, 'Detection of Quinolone-resistant enterobacterales among patients with urinary tract infection', 'Ongoing', '2026-06-10 16:33:26'),
(180, 'Adamu Mohammed Sabo', 'Nursing Sciences', '', 'IBR', '2023', 0.00, 'Determination of the relationship between age, gender, occupation, level of education, length of stay in IDP camps and post traumatic stress disorder (PTSD) among IDPs in Borno State, Nigeria', 'Ongoing', '2026-06-10 16:33:26'),
(181, 'Dr. Sabiu Aminu', 'Chemical Pathology', '', 'IBR', '2023', 0.00, 'Evaluation of oxidative stress markers and antioxidant vitamins among patients with pulmonary tuberculosis in Aminu Kano Teaching Hospital (AKTH), Kano State, Nigeria', 'Ongoing', '2026-06-10 16:33:26'),
(182, 'Dr. Ali Mohammed Baba', 'Mathematical Science', '', 'IBR', '2023', 0.00, 'Interpretation of high resolution aeromagnetic data and Landsat imaginary of younger granite province in and around Tafawa Balewa Area of Bauchi State, northeatern Nigeria', 'Ongoing', '2026-06-10 16:33:26'),
(183, 'Mohammed Abdullahi Abdullahi', 'Chemistry', '', 'IBR', '2023', 0.00, 'Biological investogation and chemical constituents of Croton Nigritanus', 'Ongoing', '2026-06-10 16:33:26'),
(184, 'Adamu Alhaji', 'Nursing sciences', '', 'IBR', '2023', 0.00, 'Assessment of relationship between emotional intelligence and conflict resolution among nurse Managers at Tertiary Health Institutions of North Easter State of Nigeria', 'Ongoing', '2026-06-10 16:33:26'),
(185, 'Prof. Calvin Chama', 'Obsterics and gynaecology', '', 'IBR', '2023', 0.00, 'Impact of decision-delivery interval on Feto-Maternal outcome in abruptio placentae', 'Ongoing', '2026-06-10 16:33:26'),
(186, 'Prof. Hamma Sabo', 'Mathematical sciences', '', 'IBR', '2023', 0.00, 'Application of markove process modelling in predicting blood sugar level among pre-diabetics &amp; diabetics patients at hospial setting', 'Ongoing', '2026-06-10 16:33:26'),
(187, 'Dr. Sabiu Bala Soja', '', '', 'IBR', '2023', 0.00, 'Exploring the Impacts of Climate-Change-Simulated Heat and IDP-Camp Dynamics on Foetal Circadian System Development in Experimental Rats', 'Ongoing', '2026-06-10 16:33:26'),
(188, 'Dr. Aishatu Yusha&#039;u Armiya&#039;u', 'Psychiatry', '', 'IBR', '2023', 0.00, 'Mental Disorders and Treatment Satisfaction in Oncology; A focus on Northeastern Nigeria', 'Ongoing', '2026-06-10 16:33:26'),
(189, 'Musa Maijidda Abubakar', 'Physiology', '', 'IBR', '2023', 0.00, 'Anti Cancer effect of Ethanol extract of Alcalypha Wilkesiana Leaf on Human Cervical Cancer (HeLa) Cell line', 'Ongoing', '2026-06-10 16:33:26'),
(190, 'Yusuf Olalekan Ahmed', 'Clinical pharmacology', '', 'IBR', '2023', 0.00, 'Modulation of cytochrome P450 and UGT1A1 by Jatropha curcas extracts: implications on pharmacokinetics of dolutegravir', 'Ongoing', '2026-06-10 16:33:26'),
(191, 'Dr. Nasir Garba Zango', 'Medical microbiology', '', 'IBR', '2023', 0.00, 'Assessment of urinary tract infection-related Acute Kidney injury among patients in Maiduguri, North-eastern Nigeria', 'Ongoing', '2026-06-10 16:33:26'),
(192, 'Alhaji Adamu Madara', 'Biology', '', 'IBR', '2023', 0.00, 'Evaluation of Anti-plasmodial activity of ethanolic stem bark extract of piliostigma thonningii schum. (Caesalpiniacea) in mice infected with plasmodium berghei berghei NK 65', 'Ongoing', '2026-06-10 16:33:26'),
(193, 'Abba Mohammed Rabiu', 'Human Anatomy', '', 'IBR', '2023', 0.00, 'Elucidating the role of Vitamin D on the Hypothalamic-Amygdalar-Cortical pathway following recurrent heat-waves and refugee camp stress in primiparous Rats', 'Ongoing', '2026-06-10 16:33:26'),
(194, 'Hussaini Yusuf Mailabari', 'Human Physiology', '', 'IBR', '2023', 0.00, 'Evaluation of Anti-Diabetic potential of Leptadenia Hastata Leaf extract in Rat model of Type 2 Diabetes Mellitus', 'Ongoing', '2026-06-10 16:33:26'),
(195, 'Ahmad Najib Suleiman', 'Chemistry', '', 'IBR', '2023', 0.00, 'Development and optimization of Biopolymer Chitosan-Pla-Based Transdermal Patch for conrolled release of Naproxen: Advancing pain management with enhance drug delivery', 'Ongoing', '2026-06-10 16:33:26'),
(196, 'Salim Aminu', 'Biology', '', 'IBR', '2023', 0.00, 'Molecular epidemiology of urinary schistomosomiasis among individuals residing in Riparian areas of Bauchi State', 'Ongoing', '2026-06-10 16:33:26'),
(197, 'Dr. Nazeef Mohammed', 'Community Medicine', '', 'IBR', '2023', 0.00, 'Assessment of Prevalence, Identification of Risk Factors and Evaluation of the Impact of Postpartum Depression on Maternal Health within Primary Healthcare Settings in Bauchi State', 'Ongoing', '2026-06-10 16:33:26'),
(198, 'Dr. Ibrahim Kurba Ibrahim', 'Human Physiology', '', 'IBR', '2023', 0.00, 'Elucidating Hepato-Pancreatic Toxic Effects of selected classes of Antibiotics on Male Wister Rats', 'Ongoing', '2026-06-10 16:33:26'),
(199, 'Sajida Lawan Bala', 'Medical Radiography', '', 'IBR', '2023', 0.00, 'Cervical cancer screening: Application of ultrasound in early prediction of cervical cancer', 'Ongoing', '2026-06-10 16:33:26'),
(200, 'Mudassir Sidi Musa', 'Medical Radiography', '', 'IBR', '2023', 0.00, 'Assessment of radiation dose to the lens of eye and thyroid of patients undergoing head computed tomography [CT] in Federal Medical Center Azare', 'Ongoing', '2026-06-10 16:33:26'),
(201, 'Rufai Yunusa', 'Histopathology', '', 'IBR', '2023', 0.00, 'Assessment of pattern of expression of oestrogen and progesterone receptors in ovarian carcinoma: A 10 year retrospective study in Aminu Kano teaching hospital', 'Ongoing', '2026-06-10 16:33:26'),
(202, 'Auwalu Mohammed', 'Mathematical sciences', '', 'IBR', '2023', 0.00, 'Analysis of disease and impact of treament using markov process modelling in patients with prostate cancer', 'Ongoing', '2026-06-10 16:33:26'),
(203, 'Aisha Mustapha', 'Biology', '', 'IBR', '2023', 0.00, 'Effects of pesticides on germination of selected crops obtained from the market in Bauchi metropolis', 'Ongoing', '2026-06-10 16:33:26'),
(204, 'Safiya Abuakar Bello', 'Biology', '', 'IBR', '2023', 0.00, 'Antischistosomal effects of annona senegalensis persoon[Annonaceae] [Gwandan  daji] leaves and stem bark extracts against schistomosa species', 'Ongoing', '2026-06-10 16:33:26'),
(205, 'Aishatu Aliyu Shehu', 'Chemistry', '', 'IBR', '2023', 0.00, 'Comparative analysis on cyanide and heavy metal levels in different varieties of cassava cultivated in katagum local government of Bauchi state', 'Ongoing', '2026-06-10 16:33:26'),
(206, 'Ibrahim Salihu', 'Nutrition and dietetics', '', 'IBR', '2023', 0.00, 'Evaluation of Mineral and Phytonutrient Profiles of Cereal-Based Tuwo commonly consumed in Matsango-Azare, Katagum Local Government Area of Bauchi State', 'Ongoing', '2026-06-10 16:33:26'),
(207, 'Aliyu Bello', 'Nutrition and dietetics', '', 'IBR', '2023', 0.00, 'Effects of cassava mill effluent on soil micro-organisms', 'Ongoing', '2026-06-10 16:33:26'),
(208, 'Muhammed Umar Giade', 'Chemistry', '', 'IBR', '2023', 0.00, 'Biogas production and evaluation using rice husk and cow dung from Katagum local government of Bauchi State', 'Ongoing', '2026-06-10 16:33:26'),
(209, 'Munkaila Abdulkarim', 'Nutrition and dietetics', '', 'IBR', '2023', 0.00, 'Effects of mycotoxins on nutritional qualities of some varieties of sorghum in Bauchi state, Nigeria', 'Ongoing', '2026-06-10 16:33:26'),
(210, 'Leah Tari Samuel', 'Biology', '', 'IBR', '2023', 0.00, 'Isolation and identification of bacteria associated with non-alcoholic local drinks sold in Azare, Bauchi State', 'Ongoing', '2026-06-10 16:33:26'),
(211, 'Baba Fugu Mohammed', 'Chemistry', '', 'IBR', '2023', 0.00, 'Some Amino subtituted phenylhdroxamic acid ligand systems as potential antibiotics: Synthesis, structural characterization, antimicrobial activities and In-silico molecular docking', 'Ongoing', '2026-06-10 16:33:26'),
(212, 'Prof. Mohammed Bukar', 'Gynae-oncology', '', 'IBR', '2023', 0.00, 'Correlation between power doppler findings on ultrasound scan and cytology in detecting preinvasive lesions of the cervix', 'Ongoing', '2026-06-10 16:33:26');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
CREATE TABLE IF NOT EXISTS `downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`id`, `title`, `description`, `file_name`, `file_path`, `file_size`, `created_at`) VALUES
(3, 'Academic Manuscript', 'Academic Manuscript', 'TETFund_ACADEMIC-MANUSCRIPT-AND-BOOK-DEVELOPMENT.pdf', 'uploads/form_1781106311_4220.pdf', 145298, '2026-06-10 15:45:11'),
(4, 'IBR ANNEXURE', 'IBR ANNEXURE', 'IBR ANNEX 3 (1).docx', 'uploads/form_1781106400_6345.docx', 12369, '2026-06-10 15:46:40'),
(5, 'IBR Proporsal Form', 'IBR Proporsal Form', 'Blank IBR proposal Form.docx', 'uploads/form_1781106431_8370.docx', 63589, '2026-06-10 15:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `caption`, `image_path`, `created_at`) VALUES
(1, 'FUHSA Main Administrative Building', 'uploads/Fuhsa_1.jpg', '2026-06-09 18:56:41'),
(2, 'Federal University of Health Sciences Azare Campus', 'uploads/Fuhsa_2.jpg', '2026-06-09 18:56:41'),
(3, 'Faculty of Basic & Clinical Sciences', 'uploads/Fuhsa_3.jpg', '2026-06-09 18:56:41'),
(4, 'Nursing Students in Lecture Hall', 'uploads/Fuhsa_4.jpg', '2026-06-09 18:56:41'),
(5, 'Distinguished Visitors to FUHSA', 'uploads/Fuhsa_5.jpg', '2026-06-09 18:56:41'),
(6, 'Medical Laboratory Science Students', 'uploads/Fuhsa_6.jpg', '2026-06-09 18:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `ibr_applications`
--

DROP TABLE IF EXISTS `ibr_applications`;
CREATE TABLE IF NOT EXISTS `ibr_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `pi_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_rank` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_category` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'Academic Staff',
  `co_investigator1` text COLLATE utf8mb4_unicode_ci,
  `co_investigator2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `research_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_months` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `budget` decimal(15,2) DEFAULT '0.00',
  `abstract` text COLLATE utf8mb4_unicode_ci,
  `problem_statement` text COLLATE utf8mb4_unicode_ci,
  `objectives` text COLLATE utf8mb4_unicode_ci,
  `ethics_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dept_approval` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Draft','Submitted','Under Review','Approved','Revision Required','Rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'Submitted',
  `assigned_reviewer_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `recommendation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reviewer_comments` text COLLATE utf8mb4_unicode_ci,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_id` (`app_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ibr_email_log`
--

DROP TABLE IF EXISTS `ibr_email_log`;
CREATE TABLE IF NOT EXISTS `ibr_email_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ibr_email_log`
--

INSERT INTO `ibr_email_log` (`id`, `recipient_email`, `subject`, `sent_at`) VALUES
(1, 'dird@fuhsa.edu.ng', 'New IBR Application: IBR-2026-7924', '2026-06-09 19:16:33'),
(2, 'hu003524@gmail.com', 'IBR Application Received: IBR-2026-7924', '2026-06-09 19:16:35'),
(3, 'hu0035240@gmail.com', 'IBR Review Assignment: IBR-2026-7924', '2026-06-09 19:20:48'),
(4, 'hu003524@gmail.com', 'IBR Application Under Review: IBR-2026-7924', '2026-06-09 19:20:50'),
(5, 'hu003524@gmail.com', 'IBR Application Status: Approved — IBR-2026-7924', '2026-06-09 19:21:03'),
(6, 'hu003524@gmail.com', 'IBR Application Status: Revision Required — IBR-2026-7924', '2026-06-09 19:21:07'),
(7, 'hu003524@gmail.com', 'IBR Application Status: Rejected — IBR-2026-7924', '2026-06-09 19:21:11'),
(8, 'hu003524@gmail.com', 'IBR Application Status: Submitted — IBR-2026-7924', '2026-06-09 19:21:15'),
(9, 'hu003524@gmail.com', 'IBR Application Status: Under Review — IBR-2026-7924', '2026-06-09 19:21:23'),
(10, 'dird@fuhsa.edu.ng', 'New IBR Application: IBR-2026-9456', '2026-06-09 20:09:18'),
(11, 'hu003524@gmail.com', 'IBR Application Received: IBR-2026-9456', '2026-06-09 20:09:20'),
(12, 'dird@fuhsa.edu.ng', 'New IBR Application: IBR-2026-4953', '2026-06-09 20:09:22'),
(13, 'hu003524@gmail.com', 'IBR Application Received: IBR-2026-4953', '2026-06-09 20:09:24'),
(14, 'hu0035240@gmail.com', 'IBR Review Assignment: IBR-2026-4953', '2026-06-09 20:10:25'),
(15, 'hu003524@gmail.com', 'IBR Application Under Review: IBR-2026-4953', '2026-06-09 20:10:27'),
(16, 'abba@gmail.com', 'FUHSA IBR Platform — Reviewer Account Created', '2026-06-09 20:25:36'),
(17, 'abba@gmail.com', 'IBR Review Assignment: IBR-2026-9456', '2026-06-09 20:26:52'),
(18, 'hu003524@gmail.com', 'IBR Application Under Review: IBR-2026-9456', '2026-06-09 20:26:54'),
(19, 'dird@fuhsa.edu.ng', 'Review Complete: IBR-2026-9456 — Score: 91/100', '2026-06-09 20:47:59'),
(20, 'dird@fuhsa.edu.ng', '📋 Review Complete: IBR-2026-9456 — Ready for Your Decision', '2026-06-09 20:48:29'),
(21, 'hu003524@gmail.com', '✅ IBR Decision: Approved — IBR-2026-9456', '2026-06-09 20:49:45'),
(22, 'dird@fuhsa.edu.ng', 'New IBR Application: IBR-2026-6252', '2026-06-09 21:01:31'),
(23, 'aisha@gmail.com', 'IBR Application Received: IBR-2026-6252', '2026-06-09 21:01:33'),
(24, 'dird@fuhsa.edu.ng', 'New IBR Application: IBR-2026-7523', '2026-06-09 21:01:35'),
(25, 'aisha@gmail.com', 'IBR Application Received: IBR-2026-7523', '2026-06-09 21:01:37'),
(26, 'abba@gmail.com', 'IBR Review Assignment: IBR-2026-6252', '2026-06-09 21:02:36'),
(27, 'aisha@gmail.com', 'IBR Application Under Review: IBR-2026-6252', '2026-06-09 21:02:38'),
(28, 'abba@gmail.com', 'IBR Review Assignment: IBR-2026-6252', '2026-06-09 21:02:40'),
(29, 'aisha@gmail.com', 'IBR Application Under Review: IBR-2026-6252', '2026-06-09 21:02:42'),
(30, 'abba@gmail.com', 'IBR Review Assignment: IBR-2026-6252', '2026-06-09 21:02:44'),
(31, 'aisha@gmail.com', 'IBR Application Under Review: IBR-2026-6252', '2026-06-09 21:02:46'),
(32, 'dird@fuhsa.edu.ng', 'Review Complete: IBR-2026-6252 — Score: 92/100', '2026-06-09 21:04:01'),
(33, 'dird@fuhsa.edu.ng', '📋 Review Complete: IBR-2026-6252 — Ready for Your Decision', '2026-06-09 21:04:09'),
(34, 'aisha@gmail.com', '✅ IBR Decision: Approved — IBR-2026-6252', '2026-06-09 21:04:52'),
(35, 'huzaifatulyaman99@gmail.com', 'FUHSA IBR Platform — Reviewer Account Created', '2026-06-10 16:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `ibr_files`
--

DROP TABLE IF EXISTS `ibr_files`;
CREATE TABLE IF NOT EXISTS `ibr_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `file_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` int(11) DEFAULT '0',
  `file_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `application_id` (`application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ibr_reviewer_files`
--

DROP TABLE IF EXISTS `ibr_reviewer_files`;
CREATE TABLE IF NOT EXISTS `ibr_reviewer_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `file_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` int(11) DEFAULT '0',
  `file_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `application_id` (`application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ibr_review_scores`
--

DROP TABLE IF EXISTS `ibr_review_scores`;
CREATE TABLE IF NOT EXISTS `ibr_review_scores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `criteria_key` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `application_id` (`application_id`,`criteria_key`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ibr_users`
--

DROP TABLE IF EXISTS `ibr_users`;
CREATE TABLE IF NOT EXISTS `ibr_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('applicant','reviewer','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'applicant',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ibr_users`
--

INSERT INTO `ibr_users` (`id`, `staff_id`, `full_name`, `email`, `phone`, `department`, `faculty`, `specialization`, `password_hash`, `role`, `created_at`) VALUES
(1, 'ADMIN', 'DIRD Administrator', 'dird@fuhsa.edu.ng', NULL, NULL, NULL, NULL, '$2y$12$dE3Xhsfcr7M3YwU2A7PFy.VIZjnJ3gpR4.w/ChK8.mA0St0ILvnRm', 'admin', '2026-06-09 18:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `leadership`
--

DROP TABLE IF EXISTS `leadership`;
CREATE TABLE IF NOT EXISTS `leadership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titles` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leadership`
--

INSERT INTO `leadership` (`id`, `role_key`, `full_name`, `titles`, `bio`, `image_path`, `updated_at`) VALUES
(2, 'Vice Chancellor', 'Prof. Bala Mohammed Audu', 'MBBS', 'Professor Abdullahi Musa Kirfi is the pioneer Vice-Chancellor of the Federal University of Health Sciences, Azare (FUHSA). A distinguished medical professional with decades of experience in obstetrics, gynaecology, and health sciences education, he brings visionary leadership to the institution. Under his stewardship, FUHSA has rapidly grown into a premier health sciences university, establishing robust academic programmes, research infrastructure, and community health initiatives across Bauchi State and beyond.', 'uploads/leader_1781107700_9082.jpg', '2026-06-10 16:36:46'),
(3, 'Deputy Vice-Chancellor (Research, Innovation and Development) Comment', 'Prof. Saad', '', 'The Directorate of Research, Innovation and Development serves as a catalyst for excellence in research, innovation, and knowledge generation within the University. Through its strategic initiatives, the Directorate continues to strengthen our research culture, promote impactful collaborations, and support innovations that contribute to improved health outcomes and national development. I commend the commitment of our staff and researchers and encourage them to continue pursuing excellence in scholarship and innovation.', 'uploads/leader_1781107856_5556.jpeg', '2026-06-10 16:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `tag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'General',
  `link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '#',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `summary`, `tag`, `link`, `created_at`) VALUES
(1, 'FUHSA IBR Platform v4 Now Live — Enhanced Submission Workflow', 'The latest IBR portal features improved proposal submission, ethics tracking, and document management for researchers.', 'Platform Launch', '#', '2026-06-09 18:56:41'),
(2, '2025/2026 TETFund IBR Grant Cycle — Applications Now Open', 'Academic staff are invited to apply for TETFund Institutional-Based Research grants. Only one proposal per staff per cycle.', 'Call for Applications', '#', '2026-06-09 18:56:41'),
(3, 'Research Methodology & Ethics Training for Academic Staff', 'A comprehensive workshop covering proposal writing, ethical considerations, and IBR submission procedures for FUHSA staff.', 'Workshop', '#', '2026-06-09 18:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

DROP TABLE IF EXISTS `publications`;
CREATE TABLE IF NOT EXISTS `publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pub_type` enum('journal','conference','thesis','book','manuscript') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'journal',
  `pub_year` year(4) NOT NULL,
  `title` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authors` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `journal` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doi` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`id`, `pub_type`, `pub_year`, `title`, `authors`, `journal`, `doi`, `created_at`) VALUES
(1, 'journal', '2024', 'Prevalence of Hypertension Among University Staff in Azare, Bauchi State: A Cross-Sectional Study', 'Musa AA, Ibrahim SM, Yusuf BK, Garba AI', 'Nigerian Journal of Clinical Practice, 27(3), 112-119', 'https://doi.org/10.4103/njcp', '2026-06-09 18:56:41'),
(2, 'journal', '2024', 'Antimicrobial Resistance Patterns of Staphylococcus aureus Isolates from Clinical Specimens in FUHSA Teaching Hospital', 'Abdullahi RO, Umar FA, Musa TL', 'African Journal of Microbiology Research, 18(2), 45-53', 'https://doi.org/10.5897/ajmr', '2026-06-09 18:56:41'),
(3, 'conference', '2024', 'Knowledge and Practice of Standard Precautions Among Nursing Students at FUHSA', 'Suleiman NB, Garba MM, Aliyu ZA', 'Proceedings of the 14th Annual Conference of the Association of Nigerian Nurses, Abuja', '', '2026-06-09 18:56:41'),
(4, 'thesis', '2024', 'Determinants of Malaria Treatment Outcomes in Children Under Five Years in Azare LGA', 'Abubakar SA (MSc Public Health, FUHSA)', 'FUHSA Institutional Repository, Bauchi State, Nigeria', '', '2026-06-09 18:56:41'),
(5, 'journal', '2023', 'Phytochemical Analysis and Antimicrobial Activity of Cassia sieberiana Extracts Against Selected Pathogens', 'Ibrahim HU, Mohammed YA, Bello KA', 'Journal of Medicinal Plants Research, 17(6), 78-86', 'https://doi.org/10.5897/jmpr', '2026-06-09 18:56:41'),
(6, 'book', '2023', 'Fundamentals of Medical Laboratory Science: A Practical Guide for Nigerian Students', 'Musa TL, Abdullahi RO (Eds.)', 'FUHSA Press, Azare, Bauchi State, Nigeria. ISBN 978-xxxxx', '', '2026-06-09 18:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `student_research`
--

DROP TABLE IF EXISTS `student_research`;
CREATE TABLE IF NOT EXISTS `student_research` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matric_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `programme` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_title` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `abstract` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_research`
--

INSERT INTO `student_research` (`id`, `student_name`, `matric_no`, `department`, `faculty`, `programme`, `project_title`, `supervisor`, `year`, `abstract`, `created_at`) VALUES
(1, 'Huzaifa Abba', 'FUHSA/24/001', 'Community Medicine', 'Medicine', 'B Sc', 'Radiological Hazard Assessment of natural Radionuclides in Soil Samples in Quarry area in Shira, Bauchi State, Nigeria', 'Dr Nazeef', '2026', 'Comparison of soybean and bambara nuts-augmented cassava flour and enhanced value assessment', '2026-06-10 16:35:10');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ibr_applications`
--
ALTER TABLE `ibr_applications`
  ADD CONSTRAINT `ibr_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ibr_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ibr_files`
--
ALTER TABLE `ibr_files`
  ADD CONSTRAINT `ibr_files_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `ibr_applications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ibr_reviewer_files`
--
ALTER TABLE `ibr_reviewer_files`
  ADD CONSTRAINT `ibr_reviewer_files_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `ibr_applications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ibr_review_scores`
--
ALTER TABLE `ibr_review_scores`
  ADD CONSTRAINT `ibr_review_scores_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `ibr_applications` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
