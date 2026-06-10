-- FUHSA DIRD Database Setup
-- Run this SQL to create the database and tables

CREATE DATABASE IF NOT EXISTS fuhsa_dird CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE fuhsa_dird;

-- Gallery photos
CREATE TABLE IF NOT EXISTS gallery (
  id INT AUTO_INCREMENT PRIMARY KEY,
  caption VARCHAR(255) NOT NULL,
  image_path VARCHAR(500) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- News articles
CREATE TABLE IF NOT EXISTS news (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(500) NOT NULL,
  summary TEXT,
  tag VARCHAR(100) DEFAULT 'General',
  link VARCHAR(500) DEFAULT '#',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Publications
CREATE TABLE IF NOT EXISTS publications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pub_type ENUM('journal','conference','thesis','book','manuscript') NOT NULL DEFAULT 'journal',
  pub_year YEAR NOT NULL,
  title VARCHAR(1000) NOT NULL,
  authors VARCHAR(1000) NOT NULL,
  journal VARCHAR(1000),
  doi VARCHAR(500) DEFAULT '',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Beneficiaries (IBR/NRF grant recipients)
CREATE TABLE IF NOT EXISTS beneficiaries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(255) NOT NULL,
  department VARCHAR(255),
  faculty VARCHAR(255),
  grant_type ENUM('IBR','NRF') NOT NULL DEFAULT 'IBR',
  grant_year YEAR NOT NULL,
  amount DECIMAL(15,2) NOT NULL DEFAULT 0,
  project_title VARCHAR(1000),
  progress ENUM('Ongoing','Completed') NOT NULL DEFAULT 'Ongoing',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Site leadership profiles (VC, DDIRD, Deans, etc.)
CREATE TABLE IF NOT EXISTS leadership (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role_key VARCHAR(255) NOT NULL,
  full_name VARCHAR(255) NOT NULL,
  titles VARCHAR(500),
  bio TEXT,
  image_path VARCHAR(500),
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Insert default leadership
INSERT INTO leadership (role_key, full_name, titles, bio, image_path) VALUES
('vc', 'Prof. Abdullahi Musa Kirfi', 'MBBS, FWACS, FMCOG', 
 'Professor Abdullahi Musa Kirfi is the pioneer Vice-Chancellor of the Federal University of Health Sciences, Azare (FUHSA). A distinguished medical professional with decades of experience in obstetrics, gynaecology, and health sciences education, he brings visionary leadership to the institution. Under his stewardship, FUHSA has rapidly grown into a premier health sciences university, establishing robust academic programmes, research infrastructure, and community health initiatives across Bauchi State and beyond.',
 'uploads/VC_Fuhsa.webp'),
('ddird', 'Dr. Ibrahim Sani Abubakar', 'PhD, MSc, BSc',
 'Dr. Ibrahim Sani Abubakar serves as the Deputy Director of the Directorate of Innovation, Research and Development (DIRD) at FUHSA. With extensive experience in health sciences research and academic administration, he coordinates institutional research activities, manages grant applications, and ensures research ethics compliance. His dedication to fostering a culture of innovation has been instrumental in driving FUHSA\'s research output and securing vital research funding.',
 'uploads/ddird_placeholder.jpg');

-- Insert sample gallery
INSERT INTO gallery (caption, image_path) VALUES
('FUHSA Main Administrative Building', 'uploads/Fuhsa_1.jpg'),
('Federal University of Health Sciences Azare Campus', 'uploads/Fuhsa_2.jpg'),
('Faculty of Basic & Clinical Sciences', 'uploads/Fuhsa_3.jpg'),
('Nursing Students in Lecture Hall', 'uploads/Fuhsa_4.jpg'),
('Distinguished Visitors to FUHSA', 'uploads/Fuhsa_5.jpg'),
('Medical Laboratory Science Students', 'uploads/Fuhsa_6.jpg');

-- Insert sample news
INSERT INTO news (title, summary, tag, link) VALUES
('FUHSA IBR Platform v4 Now Live — Enhanced Submission Workflow', 'The latest IBR portal features improved proposal submission, ethics tracking, and document management for researchers.', 'Platform Launch', '#'),
('2025/2026 TETFund IBR Grant Cycle — Applications Now Open', 'Academic staff are invited to apply for TETFund Institutional-Based Research grants. Only one proposal per staff per cycle.', 'Call for Applications', '#'),
('Research Methodology & Ethics Training for Academic Staff', 'A comprehensive workshop covering proposal writing, ethical considerations, and IBR submission procedures for FUHSA staff.', 'Workshop', '#');

-- Insert sample publications
INSERT INTO publications (pub_type, pub_year, title, authors, journal, doi) VALUES
('journal', 2024, 'Prevalence of Hypertension Among University Staff in Azare, Bauchi State: A Cross-Sectional Study', 'Musa AA, Ibrahim SM, Yusuf BK, Garba AI', 'Nigerian Journal of Clinical Practice, 27(3), 112-119', 'https://doi.org/10.4103/njcp'),
('journal', 2024, 'Antimicrobial Resistance Patterns of Staphylococcus aureus Isolates from Clinical Specimens in FUHSA Teaching Hospital', 'Abdullahi RO, Umar FA, Musa TL', 'African Journal of Microbiology Research, 18(2), 45-53', 'https://doi.org/10.5897/ajmr'),
('conference', 2024, 'Knowledge and Practice of Standard Precautions Among Nursing Students at FUHSA', 'Suleiman NB, Garba MM, Aliyu ZA', 'Proceedings of the 14th Annual Conference of the Association of Nigerian Nurses, Abuja', ''),
('thesis', 2024, 'Determinants of Malaria Treatment Outcomes in Children Under Five Years in Azare LGA', 'Abubakar SA (MSc Public Health, FUHSA)', 'FUHSA Institutional Repository, Bauchi State, Nigeria', ''),
('journal', 2023, 'Phytochemical Analysis and Antimicrobial Activity of Cassia sieberiana Extracts Against Selected Pathogens', 'Ibrahim HU, Mohammed YA, Bello KA', 'Journal of Medicinal Plants Research, 17(6), 78-86', 'https://doi.org/10.5897/jmpr'),
('book', 2023, 'Fundamentals of Medical Laboratory Science: A Practical Guide for Nigerian Students', 'Musa TL, Abdullahi RO (Eds.)', 'FUHSA Press, Azare, Bauchi State, Nigeria. ISBN 978-xxxxx', '');

-- Insert sample beneficiaries
INSERT INTO beneficiaries (full_name, department, faculty, grant_type, grant_year, amount, project_title) VALUES
('Dr. Aminu Abubakar Musa', 'Community Medicine', 'Faculty of Clinical Sciences', 'IBR', 2024, 3500000.00, 'Prevalence and Risk Factors of Non-Communicable Diseases in Azare Metropolitan Area'),
('Dr. Fatima Umar Ibrahim', 'Medical Microbiology', 'Faculty of Basic Clinical Sciences', 'IBR', 2024, 2800000.00, 'Molecular Characterization of Drug-Resistant Tuberculosis Strains in Bauchi State'),
('Dr. Suleiman Bello Garba', 'Anatomy', 'Faculty of Basic Medical Sciences', 'IBR', 2023, 3200000.00, 'Morphometric Analysis of the Human Kidney in Northeastern Nigerian Population'),
('Dr. Hauwa Mohammed Yusuf', 'Nursing Science', 'Faculty of Nursing Sciences', 'NRF', 2024, 5000000.00, 'Impact of Community Health Nursing Interventions on Maternal Mortality in Rural Bauchi'),
('Dr. Rabiu Kabir Adamu', 'Radiography', 'Faculty of Allied Health Sciences', 'NRF', 2023, 4500000.00, 'Radiation Dose Optimization in Diagnostic Imaging at Teaching Hospitals in Northeast Nigeria');

-- Downloadable forms and annexures
CREATE TABLE IF NOT EXISTS downloads (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(500) NOT NULL,
  description VARCHAR(500),
  file_name VARCHAR(500) NOT NULL,
  file_path VARCHAR(500) NOT NULL,
  file_size INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Insert existing forms
INSERT INTO downloads (title, description, file_name, file_path) VALUES
('IBR Research Proposal Template', 'Annexure 1 — Official Proposal Format (.docx)', 'IBR_Annexure-1.docx', 'uploads/IBR_Annexure-1.docx'),
('TETFund Lead Researcher Form', 'Official LR Profile Form (.pdf)', 'TETFund_Lead_Researcher_Profile_Form.pdf', 'uploads/TETFund_Lead_Researcher_Profile_Form.pdf');

-- Student Research Projects
CREATE TABLE IF NOT EXISTS student_research (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_name VARCHAR(255) NOT NULL,
  matric_no VARCHAR(100),
  department VARCHAR(255),
  faculty VARCHAR(255),
  programme VARCHAR(100),
  project_title VARCHAR(1000) NOT NULL,
  supervisor VARCHAR(255),
  year YEAR,
  abstract TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
