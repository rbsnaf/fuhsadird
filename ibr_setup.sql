-- IBR Platform Tables
-- Run AFTER setup.sql

USE fuhsa_dird;

-- Platform users (applicants, reviewers, admin/director)
CREATE TABLE IF NOT EXISTS ibr_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  staff_id VARCHAR(50) NOT NULL UNIQUE,
  full_name VARCHAR(255) NOT NULL,
  email VARCHAR(255),
  phone VARCHAR(50),
  department VARCHAR(255),
  faculty VARCHAR(255),
  specialization VARCHAR(255) DEFAULT NULL,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('applicant','reviewer','admin') DEFAULT 'applicant',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Admin user auto-created on first login via ibr_actions.php

-- IBR applications
CREATE TABLE IF NOT EXISTS ibr_applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  app_id VARCHAR(20) NOT NULL UNIQUE,
  user_id INT NOT NULL,
  pi_name VARCHAR(255) NOT NULL,
  staff_no VARCHAR(50),
  email VARCHAR(255),
  phone VARCHAR(50),
  department VARCHAR(255),
  faculty VARCHAR(255),
  academic_rank VARCHAR(100),
  staff_category VARCHAR(50) DEFAULT 'Academic Staff',
  co_investigator1 TEXT,
  co_investigator2 VARCHAR(255),
  title VARCHAR(1000) NOT NULL,
  research_area VARCHAR(255),
  duration_months INT,
  start_date DATE,
  budget DECIMAL(15,2) DEFAULT 0,
  abstract TEXT,
  problem_statement TEXT,
  objectives TEXT,
  ethics_status VARCHAR(100),
  dept_approval VARCHAR(100),
  status ENUM('Draft','Submitted','Under Review','Approved','Revision Required','Rejected') DEFAULT 'Submitted',
  assigned_reviewer_id INT DEFAULT NULL,
  score INT DEFAULT NULL,
  recommendation VARCHAR(100),
  reviewer_comments TEXT,
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  reviewed_at TIMESTAMP NULL,
  FOREIGN KEY (user_id) REFERENCES ibr_users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Uploaded documents
CREATE TABLE IF NOT EXISTS ibr_files (
  id INT AUTO_INCREMENT PRIMARY KEY,
  application_id INT NOT NULL,
  file_name VARCHAR(500) NOT NULL,
  file_path VARCHAR(500) NOT NULL,
  file_size INT DEFAULT 0,
  file_type VARCHAR(100),
  uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (application_id) REFERENCES ibr_applications(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Review scores per criteria
CREATE TABLE IF NOT EXISTS ibr_review_scores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  application_id INT NOT NULL,
  criteria_key VARCHAR(50) NOT NULL,
  score INT DEFAULT 0,
  FOREIGN KEY (application_id) REFERENCES ibr_applications(id) ON DELETE CASCADE,
  UNIQUE KEY (application_id, criteria_key)
) ENGINE=InnoDB;

-- Reviewer annotated files
CREATE TABLE IF NOT EXISTS ibr_reviewer_files (
  id INT AUTO_INCREMENT PRIMARY KEY,
  application_id INT NOT NULL,
  file_name VARCHAR(500) NOT NULL,
  file_path VARCHAR(500) NOT NULL,
  file_size INT DEFAULT 0,
  file_type VARCHAR(100),
  uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (application_id) REFERENCES ibr_applications(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Email notification log
CREATE TABLE IF NOT EXISTS ibr_email_log (
  id INT AUTO_INCREMENT PRIMARY KEY,
  recipient_email VARCHAR(255),
  subject VARCHAR(500),
  sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
