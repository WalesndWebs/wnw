-- ========================================
-- WALES & WEBS - DATABASE SCHEMA
-- Run this in phpMyAdmin on Hostinger
-- ========================================

CREATE DATABASE IF NOT EXISTS wales_webs CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE wales_webs;

-- Contact Form Submissions
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    company VARCHAR(100),
    service_type VARCHAR(50),
    budget VARCHAR(50),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied', 'closed') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_created (created_at)
) ENGINE=InnoDB;

-- Newsletter Subscribers
CREATE TABLE subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    name VARCHAR(100),
    status ENUM('active', 'unsubscribed') DEFAULT 'active',
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_status (status)
) ENGINE=InnoDB;

-- Case Studies
CREATE TABLE case_studies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    category VARCHAR(50) NOT NULL,
    description TEXT,
    challenge TEXT,
    solution TEXT,
    results TEXT,
    metric_1_label VARCHAR(50),
    metric_1_value VARCHAR(50),
    metric_2_label VARCHAR(50),
    metric_2_value VARCHAR(50),
    metric_3_label VARCHAR(50),
    metric_3_value VARCHAR(50),
    image VARCHAR(255),
    client_name VARCHAR(100),
    client_logo VARCHAR(255),
    featured BOOLEAN DEFAULT FALSE,
    status ENUM('published', 'draft') DEFAULT 'published',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category (category),
    INDEX idx_featured (featured),
    INDEX idx_status (status)
) ENGINE=InnoDB;

-- Blog Posts / Insights
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    excerpt TEXT,
    content LONGTEXT,
    category VARCHAR(50),
    featured_image VARCHAR(255),
    author VARCHAR(100),
    tags VARCHAR(255),
    status ENUM('published', 'draft') DEFAULT 'draft',
    views INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_category (category),
    INDEX idx_created (created_at)
) ENGINE=InnoDB;

-- Admin Users
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    role ENUM('super_admin', 'admin', 'editor') DEFAULT 'admin',
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_active (is_active)
) ENGINE=InnoDB;

-- Site Settings
CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    setting_group VARCHAR(50) DEFAULT 'general',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Activity Log
CREATE TABLE activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(100) NOT NULL,
    details TEXT,
    ip_address VARCHAR(45),
    user_agent VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user (user_id),
    INDEX idx_created (created_at)
) ENGINE=InnoDB;

-- Insert Default Admin (Password: admin123 - CHANGE THIS!)
-- Password hashed with bcrypt
INSERT INTO admin_users (username, email, password_hash, full_name, role) VALUES 
('admin', 'admin@walesandwebs.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Super Admin', 'super_admin');

-- Insert Default Settings
INSERT INTO settings (setting_key, setting_value, setting_group) VALUES
('site_name', 'Wales & Webs', 'general'),
('site_tagline', 'Digital Systems. Real Impact.', 'general'),
('contact_email', 'hello@walesandwebs.com', 'general'),
('contact_phone', '+234 813 436 7910', 'general'),
('contact_address', 'Lagos, Nigeria', 'general'),
('social_linkedin', 'https://linkedin.com/company/walesandwebs', 'social'),
('social_twitter', 'https://twitter.com/walesandwebs', 'social'),
('social_instagram', 'https://instagram.com/walesandwebs', 'social'),
('meta_description', 'We design and build digital systems that help businesses operate smarter, serve more, and grow continuously.', 'seo'),
('meta_keywords', 'web development, automation, digital systems, Nigeria, Lagos', 'seo');

-- Insert Sample Case Studies
INSERT INTO case_studies (title, slug, category, description, challenge, solution, results, 
    metric_1_label, metric_1_value, metric_2_label, metric_2_value, metric_3_label, metric_3_value,
    client_name, featured, status) VALUES
('SkyCapital Digital Onboarding', 'skycapital-digital-onboarding', 'FinTech', 
 'End-to-end onboarding system that verifies, assesses, and manages customers seamlessly.',
 'Manual onboarding was slow, error-prone, and couldn't scale with customer growth.',
 'Built a fully automated digital onboarding system with KYC verification, document upload, and real-time status tracking.',
 'Reduced onboarding time by 80% while maintaining 99.9% accuracy.',
 'Users Onboarded', '10K+', 'Processing Time', '80%', 'Accuracy Rate', '99.9%',
 'SkyCapital', TRUE, 'published'),

('Taste by Edima', 'taste-by-edima', 'Restaurant',
 'Restaurant website with online ordering, gallery, and brand storytelling that boosted customer engagement.',
 'No online presence meant missed orders and poor customer engagement.',
 'Created a modern website with online ordering, photo gallery, reservation system, and integrated payment.',
 'Significant increase in online orders and customer retention.',
 'Online Orders', '+65%', 'Engagement', '+120%', 'Repeat Customers', '+85%',
 'Taste by Edima', TRUE, 'published'),

('Laundry Management System', 'laundry-management-system', 'Operations',
 'A complete laundry management solution that automated operations and improved tracking.',
 'Manual tracking led to lost items, delayed deliveries, and unhappy customers.',
 'Built a full management system with order tracking, inventory, customer notifications, and delivery scheduling.',
 'Streamlined operations and improved customer satisfaction dramatically.',
 'Orders Managed', '5K+', 'Efficiency', '+70%', 'Customer Satisfaction', '98%',
 'FreshPress Laundry', TRUE, 'published'),

('AdeConcept Corporate Website', 'adeconcept-corporate-website', 'Corporate',
 'A modern corporate website that positions AdeConcept as a trusted printing & branding partner.',
 'Outdated website wasn't generating leads or reflecting their brand quality.',
 'Designed and developed a modern, fast, SEO-optimized corporate website with portfolio and contact forms.',
 'Massive increase in lead generation and brand visibility.',
 'Leads Generated', '+90%', 'Brand Visibility', '+85%', 'Engagement', '+110%',
 'AdeConcept', TRUE, 'published');

-- Insert Sample Blog Posts
INSERT INTO posts (title, slug, excerpt, category, author, status) VALUES
('Why 80% of Business Websites Don't Generate Leads (And How to Fix It)', 
 'why-business-websites-dont-generate-leads',
 'Most business websites are just digital brochures. Learn how to turn yours into a lead-generating machine.',
 'Strategy', 'Wales & Webs Team', 'published'),

('The Power of Business Automation: Save Time, Increase Profit',
 'power-of-business-automation',
 'Discover how automating repetitive tasks can free up your team and boost your bottom line.',
 'Automation', 'Wales & Webs Team', 'published'),

('User Experience Design Principles That Increase Conversions',
 'ux-design-principles-conversions',
 'Simple UX changes can double your conversion rate. Here are the principles that actually work.',
 'Design', 'Wales & Webs Team', 'published'),

('How Digital Systems Help Businesses Scale Without Chaos',
 'digital-systems-scale-without-chaos',
 'Scaling a business without proper systems leads to chaos. Here's how to do it right.',
 'Growth', 'Wales & Webs Team', 'published');
