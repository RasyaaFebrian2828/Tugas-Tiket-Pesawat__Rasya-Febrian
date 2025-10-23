<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Dashboard Publik - Singa Tanah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <style>
        /* kecil saja supaya dropdown rapi tanpa Alpine */
        .hidden-on-load { display: none; }
        
        /* Custom Styles */
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .flight-card {
            border-left: 4px solid #e11d48;
        }
        
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .badge-success {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .search-box {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .notification-badge {
            position: absolute;
            top: -0.5rem;
            right: -0.5rem;
            background-color: #e11d48;
            color: white;
            border-radius: 9999px;
            width: 1.25rem;
            height: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .mobile-menu {
            transition: all 0.3s ease;
        }
        
        .mobile-menu.open {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
        
        .mobile-menu.closed {
            display: none;
            opacity: 0;
            transform: translateY(-10px);
        }
        
        .floating-action-button {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 9999px;
            background-color: #e11d48;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            z-index: 40;
            transition: all 0.3s ease;
        }
        
        .floating-action-button:hover {
            transform: scale(1.1);
            background-color: #be123c;
        }
        
        .flight-path {
            display: flex;
            align-items: center;
            position: relative;
        }
        
        .flight-path::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #e5e7eb;
            z-index: 1;
        }
        
        .flight-path-point {
            position: relative;
            z-index: 2;
            background-color: white;
            border: 2px solid #e11d48;
            border-radius: 9999px;
            width: 1rem;
            height: 1rem;
        }
        
        .flight-path-line {
            flex: 1;
            height: 2px;
            background-color: #e5e7eb;
            position: relative;
        }
        
        .flight-path-line.active {
            background-color: #e11d48;
        }
        
        .flight-path-line::after {
            content: '✈';
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            color: #e11d48;
            font-size: 0.75rem;
        }
        
        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-around;
            padding: 0.5rem 0;
            z-index: 50;
        }
        
        .mobile-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.5rem;
            color: #6b7280;
            font-size: 0.75rem;
        }
        
        .mobile-nav-item.active {
            color: #e11d48;
        }
        
        .mobile-nav-icon {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }
        
        .flight-card-header {
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
            color: white;
            border-radius: 0.5rem 0.5rem 0 0;
            padding: 0.75rem 1rem;
        }
        
        .flight-card-body {
            padding: 1rem;
            border-left: 1px solid #e5e7eb;
            border-right: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
            border-radius: 0 0 0.5rem 0.5rem;
        }
        
        .flight-duration {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 0 1rem;
        }
        
        .flight-duration::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #e5e7eb;
        }
        
        .flight-duration-text {
            background-color: white;
            padding: 0 0.5rem;
            position: relative;
            z-index: 1;
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .flight-time {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .flight-time .time {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
        }
        
        .flight-time .city {
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .flight-time .date {
            font-size: 0.75rem;
            color: #9ca3af;
        }
        
        .flight-airline {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .flight-airline-logo {
            width: 2rem;
            height: 2rem;
            border-radius: 9999px;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
            color: #e11d48;
        }
        
        .flight-airline-name {
            font-weight: 500;
            color: #374151;
        }
        
        .flight-details-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .flight-details-toggle:hover {
            color: #e11d48;
        }
        
        .flight-details-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        .flight-details-content.open {
            max-height: 500px;
        }
        
        .flight-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .badge-promo {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .badge-popular {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .badge-eco {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .flight-notice {
            background-color: #fef3c7;
            border: 1px solid #fbbf24;
            border-radius: 0.375rem;
            padding: 0.75rem;
            margin-top: 1rem;
        }
        
        .notice-title {
            font-weight: 600;
            color: #92400e;
            margin-bottom: 0.25rem;
        }
        
        .notice-text {
            font-size: 0.875rem;
            color: #92400e;
        }
        
        .flight-loading {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .loading-line {
            height: 1rem;
            border-radius: 0.25rem;
            background-color: #f3f4f6;
        }
        
        .loading-line.short {
            width: 60%;
        }
        
        .loading-line.medium {
            width: 80%;
        }
        
        .loading-line.long {
            width: 100%;
        }
        
        .pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }
        
        .pagination-item {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .pagination-item:hover {
            background-color: #f3f4f6;
        }
        
        .pagination-item.active {
            background-color: #e11d48;
            color: white;
        }
        
        .pagination-item.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .pagination-item.disabled:hover {
            background-color: transparent;
        }
        
        .flight-filters {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        
        .filter-section {
            margin-bottom: 1.5rem;
        }
        
        .filter-section:last-child {
            margin-bottom: 0;
        }
        
        .filter-title {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.75rem;
        }
        
        .filter-options {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .filter-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .filter-checkbox {
            width: 1rem;
            height: 1rem;
            border-radius: 0.25rem;
            border: 1px solid #d1d5db;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        
        .filter-checkbox.checked {
            background-color: #e11d48;
            border-color: #e11d48;
        }
        
        .filter-checkbox.checked::after {
            content: '✓';
            color: white;
            font-size: 0.75rem;
        }
        
        .filter-label {
            font-size: 0.875rem;
            color: #374151;
            cursor: pointer;
        }
        
        .price-range {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .price-input {
            width: 100%;
            height: 0.5rem;
            border-radius: 0.25rem;
            background-color: #e5e7eb;
            outline: none;
            -webkit-appearance: none;
        }
        
        .price-input::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            background: #e11d48;
            cursor: pointer;
        }
        
        .price-input::-moz-range-thumb {
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            background: #e11d48;
            cursor: pointer;
            border: none;
        }
        
        .price-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 0.5rem;
            font-size: 0.75rem;
            color: #6b7280;
        }
        
        .flight-sort {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .sort-label {
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .sort-select {
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background-color: white;
            font-size: 0.875rem;
            color: #374151;
            outline: none;
        }
        
        .sort-select:focus {
            border-color: #e11d48;
        }
        
        .flight-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .flight-list-item {
            background-color: white;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        
        .flight-list-item:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .flight-list-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background-color: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .flight-list-body {
            padding: 1rem;
        }
        
        .flight-list-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }
        
        .flight-list-price {
            font-size: 1.25rem;
            font-weight: 600;
            color: #e11d48;
        }
        
        .flight-list-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .btn-primary {
            background-color: #e11d48;
            color: white;
            border: 1px solid #e11d48;
        }
        
        .btn-primary:hover {
            background-color: #be123c;
            border-color: #be123c;
        }
        
        .btn-outline {
            background-color: white;
            color: #374151;
            border: 1px solid #d1d5db;
        }
        
        .btn-outline:hover {
            background-color: #f9fafb;
            border-color: #9ca3af;
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }
        
        .flight-details-grid {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 1rem;
            align-items: center;
        }
        
        .flight-info {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .flight-info-label {
            font-size: 0.75rem;
            color: #6b7280;
        }
        
        .flight-info-value {
            font-weight: 500;
            color: #374151;
        }
        
        .flight-route {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .flight-duration {
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .flight-stops {
            font-size: 0.75rem;
            color: #9ca3af;
        }
        
        .flight-aircraft {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .flight-amenities {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        
        .amenity {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.75rem;
            color: #6b7280;
        }
        
        .amenity-icon {
            width: 1rem;
            height: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .flight-seats {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        
        .seat-availability {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.75rem;
            color: #6b7280;
        }
        
        .seat-indicator {
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 9999px;
        }
        
        .seat-available .seat-indicator {
            background-color: #10b981;
        }
        
        .seat-limited .seat-indicator {
            background-color: #f59e0b;
        }
        
        .seat-few .seat-indicator {
            background-color: #ef4444;
        }
        
        .flight-status-widget {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        
        .status-indicator {
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 9999px;
            margin-right: 0.5rem;
        }
        
        .status-on-time .status-indicator {
            background-color: #10b981;
        }
        
        .status-delayed .status-indicator {
            background-color: #f59e0b;
        }
        
        .status-cancelled .status-indicator {
            background-color: #ef4444;
        }
        
        .flight-status-item {
            display: flex;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .flight-status-item:last-child {
            border-bottom: none;
        }
        
        .flight-status-code {
            font-weight: 600;
            color: #374151;
            min-width: 4rem;
        }
        
        .flight-status-route {
            flex: 1;
            color: #6b7280;
        }
        
        .flight-status-time {
            font-weight: 500;
            color: #374151;
        }
        
        .about-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 1rem;
            overflow: hidden;
        }
        
        .feature-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .feature-icon {
            width: 4rem;
            height: 4rem;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .icon-red {
            background-color: #fef2f2;
            color: #e11d48;
        }
        
        .icon-blue {
            background-color: #eff6ff;
            color: #3b82f6;
        }
        
        .icon-green {
            background-color: #f0fdf4;
            color: #22c55e;
        }
        
        .icon-purple {
            background-color: #faf5ff;
            color: #a855f7;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #e11d48;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
        }
        
        .promo-section {
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
            border-radius: 1rem;
            overflow: hidden;
        }
        
        .promo-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 0.75rem;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .service-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            border-left: 4px solid #e11d48;
        }
        
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .service-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.25rem;
            background-color: #fef2f2;
            color: #e11d48;
        }
        
        .testimonial-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-left: 4px solid #e11d48;
        }
        
        .testimonial-avatar {
            width: 3rem;
            height: 3rem;
            border-radius: 9999px;
            object-fit: cover;
        }
        
        .news-card {
            background: white;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .news-image {
            width: 100%;
            height: 12rem;
            object-fit: cover;
        }
        
        /* New styles for improved frontend */
        .maskapai-info-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 1rem;
            padding: 2rem;
        }
        
        .maskapai-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .info-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            border-top: 4px solid #e11d48;
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .info-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.25rem;
            background-color: #fef2f2;
            color: #e11d48;
        }
        
        .timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: #e11d48;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }
        
        .timeline-item {
            padding: 10px 40px;
            position: relative;
            width: 50%;
            box-sizing: border-box;
        }
        
        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: white;
            border: 4px solid #e11d48;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }
        
        .left {
            left: 0;
        }
        
        .right {
            left: 50%;
        }
        
        .left::after {
            right: -10px;
        }
        
        .right::after {
            left: -10px;
        }
        
        .timeline-content {
            padding: 20px;
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .timeline-content h3 {
            margin-top: 0;
            color: #e11d48;
        }
        
        @media (max-width: 768px) {
            .flight-details-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .flight-route {
                order: -1;
            }
            
            .mobile-bottom-nav {
                display: flex;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .timeline::after {
                left: 31px;
            }
            
            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }
            
            .timeline-item::after {
                left: 21px;
            }
            
            .right {
                left: 0%;
            }
        }
        
        @media (min-width: 769px) {
            .mobile-bottom-nav {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

<!-- Header -->
<header class="bg-red-600 p-4 text-white sticky top-0 z-40 shadow-md">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="bg-white p-1 rounded-lg">
                <img src="{{ asset('images/singatanah-logo.png') }}" alt="Singa Tanah" class="h-8">
            </div>
            <span class="font-bold text-lg">Singa Tanah</span>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center gap-6">
            <a href="#beranda" class="font-medium hover:text-red-100 transition-colors">Beranda</a>
            <a href="#penerbangan" class="font-medium hover:text-red-100 transition-colors">Penerbangan</a>
            <a href="#tentang-kami" class="font-medium hover:text-red-100 transition-colors">Tentang Kami</a>
            <a href="#bantuan" class="font-medium hover:text-red-100 transition-colors">Bantuan</a>
            <a href="#kontak" class="font-medium hover:text-red-100 transition-colors">Kontak</a>
        </nav>

        <div class="flex items-center gap-3">
            <!-- Notification Bell -->
            <div class="relative">
                <button class="p-2 rounded-full hover:bg-red-700 transition-colors">
                    <i class="fas fa-bell"></i>
                </button>
                <span class="notification-badge">3</span>
            </div>
            
            <!-- Language Selector -->
            <div class="hidden md:block relative">
                <button class="flex items-center gap-1 px-3 py-1 rounded hover:bg-red-700 transition-colors">
                    <i class="fas fa-globe"></i>
                    <span>ID</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
            </div>
            
            @guest
                <a href="{{ route('login') }}" class="bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">Login</a>
                <a href="{{ route('register') }}" class="bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">Register</a>
            @else
                <!-- profile dropdown -->
                <div class="relative" id="profileRoot">
                    <button id="profileBtn" class="flex items-center gap-2 bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                        <img src="{{ asset('images/avatar.png') }}" alt="avatar" class="w-8 h-8 rounded-full object-cover">
                        <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div id="profileMenu" class="absolute right-0 mt-2 w-56 bg-white text-gray-800 rounded-lg shadow-xl hidden-on-load z-50 overflow-hidden">
                        <div class="p-4 border-b">
                            <p class="font-semibold">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('pemesanan.index') }}" class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-gray-100 transition-colors">
                            <i class="fas fa-ticket-alt w-5"></i>
                            <span>Pesanan Saya</span>
                        </a>
                        <a href="{{ route('user.dashboard') }}" class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-gray-100 transition-colors">
                            <i class="fas fa-user-circle w-5"></i>
                            <span>Profil Saya</span>
                        </a>
                        <a href="#" class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-gray-100 transition-colors">
                            <i class="fas fa-gift w-5"></i>
                            <span>Rewards Saya</span>
                        </a>
                        <div class="border-t"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-3 text-sm hover:bg-gray-100 text-red-600 transition-colors">
                                <i class="fas fa-sign-out-alt w-5"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endguest
            
            <!-- Mobile Menu Button -->
            <button id="mobileMenuButton" class="md:hidden p-2 rounded-lg hover:bg-red-700 transition-colors">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu closed md:hidden bg-red-600 mt-2 py-3 px-4 rounded-lg shadow-lg">
        <nav class="flex flex-col gap-3">
            <a href="#beranda" class="font-medium hover:text-red-100 transition-colors py-1">Beranda</a>
            <a href="#penerbangan" class="font-medium hover:text-red-100 transition-colors py-1">Penerbangan</a>
            <a href="#tentang-kami" class="font-medium hover:text-red-100 transition-colors py-1">Tentang Kami</a>
            <a href="#bantuan" class="font-medium hover:text-red-100 transition-colors py-1">Bantuan</a>
            <a href="#kontak" class="font-medium hover:text-red-100 transition-colors py-1">Kontak</a>
            <div class="border-t border-red-500 pt-3 mt-1">
                <a href="#" class="flex items-center gap-2 font-medium hover:text-red-100 transition-colors py-1">
                    <i class="fas fa-globe"></i>
                    <span>Bahasa Indonesia</span>
                </a>
            </div>
        </nav>
    </div>
</header>

<!-- Hero Section -->
<section id="beranda" class="hero-gradient text-white py-12 md:py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="md:w-1/2">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Jelajahi Dunia Bersama Singa Tanah</h1>
                <p class="text-xl mb-8 opacity-90">Terbang dengan nyaman dan aman ke berbagai destinasi impian Anda dengan harga terbaik.</p>
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-red-200"></i>
                        <span>Harga Terjangkau</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-red-200"></i>
                        <span>Destinasi Luas</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-red-200"></i>
                        <span>Layanan Terbaik</span>
                    </div>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <div class="bg-white rounded-2xl p-6 search-box max-w-md w-full">
                    <div class="flex flex-col items-center justify-center h-full">
                        <div class="w-48 h-48 mb-6 flex items-center justify-center">
                            <i class="fas fa-plane text-red-500 text-8xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Maskapai Terpercaya</h3>
                        <p class="text-gray-600 text-center mb-6">Terbang dengan armada modern dan layanan terbaik untuk pengalaman perjalanan yang tak terlupakan.</p>
                        <a href="#penerbangan" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-search"></i>
                            Lihat Penerbangan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Promo Section -->
<section id="penerbangan" class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Penawaran Spesial</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Nikmati berbagai penawaran menarik untuk penerbangan Anda</p>
        </div>
        
        <div class="promo-section p-8 text-white">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="promo-card text-center">
                    <div class="text-4xl font-bold mb-2">30%</div>
                    <h3 class="text-lg font-semibold mb-2">Diskon Awal Tahun</h3>
                    <p class="text-white text-opacity-80 text-sm">Untuk semua penerbangan domestik hingga 31 Januari</p>
                </div>
                
                <div class="promo-card text-center">
                    <div class="text-4xl font-bold mb-2">B1G1</div>
                    <h3 class="text-lg font-semibold mb-2">Buy 1 Get 1</h3>
                    <p class="text-white text-opacity-80 text-sm">Untuk penerbangan internasional pilihan</p>
                </div>
                
                <div class="promo-card text-center">
                    <div class="text-4xl font-bold mb-2">20%</div>
                    <h3 class="text-lg font-semibold mb-2">Cashback</h3>
                    <p class="text-white text-opacity-80 text-sm">Pembayaran dengan e-wallet partner</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Maskapai Info Section (Replacing Destinasi Populer) -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Tentang Maskapai Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Mengenal lebih dekat Singa Tanah dan komitmen kami dalam memberikan layanan terbaik</p>
        </div>
        
        <div class="maskapai-info-section">
            <div class="maskapai-info-grid">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Sejarah</h3>
                    <p class="text-gray-600 text-sm">Didirikan pada tahun 2005, Singa Tanah telah berkembang menjadi salah satu maskapai penerbangan terbesar di Indonesia dengan jaringan rute yang luas.</p>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Prestasi</h3>
                    <p class="text-gray-600 text-sm">Singa Tanah telah menerima berbagai penghargaan atas komitmennya terhadap keselamatan dan kualitas layanan penerbangan.</p>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Komitmen Lingkungan</h3>
                    <p class="text-gray-600 text-sm">Kami berkomitmen untuk mengurangi dampak lingkungan dengan armada modern yang lebih efisien bahan bakar dan program ramah lingkungan.</p>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Kemitraan</h3>
                    <p class="text-gray-600 text-sm">Bekerja sama dengan berbagai maskapai internasional untuk memberikan pengalaman perjalanan yang lebih baik bagi penumpang.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Layanan Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Layanan Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Berbagai layanan terbaik untuk pengalaman terbang yang tak terlupakan</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-suitcase-rolling"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Bagasi Ekstra</h3>
                <p class="text-gray-600 text-sm">Tambah kapasitas bagasi untuk kenyamanan perjalanan Anda</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Makanan Spesial</h3>
                <p class="text-gray-600 text-sm">Pilihan menu makanan yang lezat selama penerbangan</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-wifi"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Wi-Fi Gratis</h3>
                <p class="text-gray-600 text-sm">Tetap terhubung dengan internet selama penerbangan</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-couch"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Kursi Prioritas</h3>
                <p class="text-gray-600 text-sm">Pilih kursi favorit Anda untuk kenyamanan maksimal</p>
            </div>
        </div>
    </div>
</section>

<!-- Tentang Singa Tanah Section -->
<section id="tentang-kami" class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Tentang Singa Tanah</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">Singa Tanah adalah maskapai penerbangan terkemuka di Indonesia yang telah melayani jutaan penumpang dengan jaringan rute domestik dan internasional yang luas.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Feature 1 -->
            <div class="feature-card card-hover">
                <div class="feature-icon icon-red">
                    <i class="fas fa-plane"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Armada Modern</h3>
                <p class="text-gray-600">Lebih dari 100 pesawat dengan teknologi terkini untuk kenyamanan dan keamanan perjalanan Anda.</p>
            </div>
            
            <!-- Feature 2 -->
            <div class="feature-card card-hover">
                <div class="feature-icon icon-blue">
                    <i class="fas fa-route"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Jaringan Luas</h3>
                <p class="text-gray-600">Melayani lebih dari 60 destinasi di Indonesia dan berbagai kota internasional di Asia.</p>
            </div>
            
            <!-- Feature 3 -->
            <div class="feature-card card-hover">
                <div class="feature-icon icon-green">
                    <i class="fas fa-award"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Layanan Terbaik</h3>
                <p class="text-gray-600">Komitmen untuk memberikan pengalaman terbang yang menyenangkan dengan layanan berkualitas.</p>
            </div>
            
            <!-- Feature 4 -->
            <div class="feature-card card-hover">
                <div class="feature-icon icon-purple">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Keamanan Terjamin</h3>
                <p class="text-gray-600">Standar keamanan dan keselamatan tertinggi dengan sertifikasi internasional.</p>
            </div>
        </div>
        
        <!-- Statistics -->
        <div class="stats-grid mb-12">
            <div class="stat-card">
                <div class="stat-number">18+</div>
                <div class="stat-label">Tahun Pengalaman</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">60+</div>
                <div class="stat-label">Destinasi</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">100+</div>
                <div class="stat-label">Pesawat</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">40Jt+</div>
                <div class="stat-label">Penumpang/Tahun</div>
            </div>
        </div>
    </div>
</section>

<!-- Testimoni Section -->
<section id="bantuan" class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Apa Kata Pelanggan Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Pengalaman nyata dari penumpang setia Singa Tanah</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="testimonial-card">
                <div class="flex items-center gap-3 mb-4">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" alt="Customer" class="testimonial-avatar">
                    <div>
                        <h4 class="font-semibold text-gray-800">Sarah Wijaya</h4>
                        <p class="text-sm text-gray-600">Business Traveler</p>
                    </div>
                </div>
                <p class="text-gray-600">"Pelayanan Singa Tanah sangat memuaskan. Penerbangan tepat waktu dan kru kabin sangat ramah. Recommended!"</p>
                <div class="flex text-yellow-400 mt-3">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="flex items-center gap-3 mb-4">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" alt="Customer" class="testimonial-avatar">
                    <div>
                        <h4 class="font-semibold text-gray-800">Budi Santoso</h4>
                        <p class="text-sm text-gray-600">Family Traveler</p>
                    </div>
                </div>
                <p class="text-gray-600">"Harga terjangkau dengan kualitas pelayanan yang baik. Keluarga saya selalu memilih Singa Tanah untuk liburan."</p>
                <div class="flex text-yellow-400 mt-3">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="flex items-center gap-3 mb-4">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" alt="Customer" class="testimonial-avatar">
                    <div>
                        <h4 class="font-semibold text-gray-800">Dewi Lestari</h4>
                        <p class="text-sm text-gray-600">Frequent Flyer</p>
                    </div>
                </div>
                <p class="text-gray-600">"Program rewards Singa Tanah sangat menguntungkan. Sudah berkali-kali dapat diskon dan upgrade gratis."</p>
                <div class="flex text-yellow-400 mt-3">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<main class="p-6 flex-1 max-w-7xl mx-auto w-full">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div class="md:w-1/4">
            <div class="flight-filters sticky top-24">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter Penerbangan</h3>
                
                <!-- Filter Waktu Keberangkatan -->
                <div class="filter-section">
                    <h4 class="filter-title">Waktu Keberangkatan</h4>
                    <div class="filter-options">
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-label">Pagi (00:00 - 06:00)</span>
                        </div>
                        <div class="filter-option">
                            <div class="filter-checkbox checked"></div>
                            <span class="filter-label">Siang (06:00 - 12:00)</span>
                        </div>
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-label">Sore (12:00 - 18:00)</span>
                        </div>
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-label">Malam (18:00 - 24:00)</span>
                        </div>
                    </div>
                </div>
                
                <!-- Filter Harga -->
                <div class="filter-section">
                    <h4 class="filter-title">Kisaran Harga</h4>
                    <input type="range" min="0" max="10000000" value="5000000" class="price-input">
                    <div class="price-labels">
                        <span>Rp 0</span>
                        <span>Rp 10.000.000</span>
                    </div>
                </div>
                
                <!-- Filter Durasi -->
                <div class="filter-section">
                    <h4 class="filter-title">Durasi Penerbangan</h4>
                    <div class="filter-options">
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-label">≤ 1 jam</span>
                        </div>
                        <div class="filter-option">
                            <div class="filter-checkbox checked"></div>
                            <span class="filter-label">1 - 3 jam</span>
                        </div>
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-label">≥ 3 jam</span>
                        </div>
                    </div>
                </div>
                
                <button class="w-full bg-red-600 text-white py-2 rounded-lg font-medium hover:bg-red-700 transition-colors mt-4">
                    Terapkan Filter
                </button>
            </div>
            
            <!-- Flight Status Widget -->
            <div class="flight-status-widget mt-6">
                <h3 class="font-semibold text-gray-800 mb-4">Status Penerbangan</h3>
                
                <div class="flight-status-item status-on-time">
                    <div class="status-indicator"></div>
                    <div class="flight-status-code">ST 123</div>
                    <div class="flight-status-route">CGK - DPS</div>
                    <div class="flight-status-time">10:30</div>
                </div>
                
                <div class="flight-status-item status-delayed">
                    <div class="status-indicator"></div>
                    <div class="flight-status-code">ST 456</div>
                    <div class="flight-status-route">SUB - JOG</div>
                    <div class="flight-status-time">11:45</div>
                </div>
                
                <div class="flight-status-item status-on-time">
                    <div class="status-indicator"></div>
                    <div class="flight-status-code">ST 789</div>
                    <div class="flight-status-route">BDO - UPG</div>
                    <div class="flight-status-time">13:20</div>
                </div>
                
                <a href="#" class="block text-center text-red-600 font-medium mt-4 hover:text-red-700 transition-colors text-sm">
                    Lihat Semua Status
                </a>
            </div>
        </div>
        
        <!-- Flight List -->
        <div class="md:w-3/4">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Daftar Penerbangan</h1>
                
                <div class="flight-sort">
                    <span class="sort-label">Urutkan:</span>
                    <select class="sort-select">
                        <option>Harga Terendah</option>
                        <option>Harga Tertinggi</option>
                        <option>Durasi Terpendek</option>
                        <option>Keberangkatan Terawal</option>
                    </select>
                </div>
            </div>
            
            @if($penerbangan && $penerbangan->count())
                <div class="flight-list">
                    @foreach($penerbangan as $p)
                        <div class="flight-list-item card-hover">
                            <div class="flight-list-header">
                                <div class="flight-airline">
                                    <div class="flight-airline-logo">
                                        ST
                                    </div>
                                    <div class="flight-airline-name">
                                        Singa Tanah
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="flight-badge badge-promo">
                                        <i class="fas fa-bolt"></i>
                                        PROMO
                                    </span>
                                    <span class="flight-badge badge-popular">
                                        <i class="fas fa-fire"></i>
                                        POPULER
                                    </span>
                                </div>
                            </div>
                            
                            <div class="flight-list-body">
                                <div class="flight-details-grid">
                                    <div class="flight-info">
                                        <div class="flight-time">
                                            <div class="time">
                                                {{ optional($p->waktu_berangkat ?? $p->departure_time ?? null)
                                                    ? \Illuminate\Support\Carbon::parse($p->waktu_berangkat ?? $p->departure_time)->format('H:i')
                                                    : '--:--' }}
                                            </div>
                                            <div class="city">{{ $p->asal ?? $p->origin ?? '-' }}</div>
                                            <div class="date">
                                                {{ optional($p->waktu_berangkat ?? $p->departure_time ?? null)
                                                    ? \Illuminate\Support\Carbon::parse($p->waktu_berangkat ?? $p->departure_time)->format('d M Y')
                                                    : '-' }}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="flight-route">
                                        <div class="flight-duration">
                                            <i class="fas fa-clock mr-1"></i>
                                            1j 45m
                                        </div>
                                        <div class="flight-path">
                                            <div class="flight-path-point"></div>
                                            <div class="flight-path-line active"></div>
                                            <div class="flight-path-point"></div>
                                        </div>
                                        <div class="flight-stops">Langsung</div>
                                    </div>
                                    
                                    <div class="flight-info text-right">
                                        <div class="flight-time">
                                            <div class="time">
                                                {{ optional($p->waktu_berangkat ?? $p->departure_time ?? null)
                                                    ? \Illuminate\Support\Carbon::parse($p->waktu_berangkat ?? $p->departure_time)->addHours(1)->addMinutes(45)->format('H:i')
                                                    : '--:--' }}
                                            </div>
                                            <div class="city">{{ $p->tujuan ?? $p->destination ?? '-' }}</div>
                                            <div class="date">
                                                {{ optional($p->waktu_berangkat ?? $p->departure_time ?? null)
                                                    ? \Illuminate\Support\Carbon::parse($p->waktu_berangkat ?? $p->departure_time)->addHours(1)->addMinutes(45)->format('d M Y')
                                                    : '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flight-amenities">
                                    <div class="amenity">
                                        <div class="amenity-icon">
                                            <i class="fas fa-utensils"></i>
                                        </div>
                                        <span>Makanan</span>
                                    </div>
                                    <div class="amenity">
                                        <div class="amenity-icon">
                                            <i class="fas fa-suitcase-rolling"></i>
                                        </div>
                                        <span>20kg Bagasi</span>
                                    </div>
                                    <div class="amenity">
                                        <div class="amenity-icon">
                                            <i class="fas fa-wifi"></i>
                                        </div>
                                        <span>Wi-Fi</span>
                                    </div>
                                </div>
                                
                                <div class="flight-notice">
                                    <div class="notice-title">Informasi Penting</div>
                                    <div class="notice-text">
                                        Penerbangan ini mematuhi protokol kesehatan yang ketat. Semua penumpang diwajibkan memakai masker selama penerbangan.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flight-list-footer">
                                <div>
                                    <div class="flight-list-price">
                                        Rp {{ number_format($p->harga ?? $p->price ?? 0,0,',','.') }}
                                    </div>
                                    <div class="text-sm text-gray-500">per orang</div>
                                </div>
                                
                                <div class="flight-list-actions">
                                    @auth
                                        @if(auth()->user()->role === 'user')
                                            @php
                                                $kelasList = $p->kelas ?? ($p->classes ?? null);
                                            @endphp

                                            @if($kelasList && count($kelasList))
                                                @foreach($kelasList as $kelas)
                                                    <a href="{{ route('pemesanan.create', $kelas->id) }}"
                                                       class="btn btn-primary btn-sm">
                                                        Pesan {{ $kelas->nama_kelas ?? $kelas->name ?? 'Kelas' }}
                                                    </a>
                                                @endforeach
                                            @else
                                                <a href="{{ route('pemesanan.create', $p->id) }}"
                                                   class="btn btn-primary btn-sm">
                                                    Pesan Tiket
                                                </a>
                                            @endif
                                        @else
                                            <span class="text-sm text-gray-500">Tidak untuk admin</span>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Login untuk pesan</a>
                                    @endauth
                                    
                                    <button class="btn btn-outline btn-sm flight-details-toggle">
                                        <i class="fas fa-info-circle"></i>
                                        Detail
                                    </button>
                                </div>
                            </div>
                            
                            <div class="flight-details-content">
                                <div class="p-4 border-t">
                                    <h4 class="font-semibold text-gray-800 mb-3">Detail Penerbangan</h4>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <h5 class="font-medium text-gray-700 mb-2">Informasi Penerbangan</h5>
                                            <div class="space-y-2">
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Kode Penerbangan:</span>
                                                    <span class="font-medium">{{ $p->kode ?? $p->kode_penerbangan ?? $p->flight_number ?? '-' }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Pesawat:</span>
                                                    <span class="font-medium">Boeing 737-800</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Durasi:</span>
                                                    <span class="font-medium">1 jam 45 menit</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <h5 class="font-medium text-gray-700 mb-2">Fasilitas</h5>
                                            <div class="flex flex-wrap gap-2">
                                                <span class="badge badge-success">Makanan</span>
                                                <span class="badge badge-success">Bagasi 20kg</span>
                                                <span class="badge badge-success">Wi-Fi</span>
                                                <span class="badge badge-warning">Hiburan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="pagination">
                    <div class="pagination-item disabled">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="pagination-item active">1</div>
                    <div class="pagination-item">2</div>
                    <div class="pagination-item">3</div>
                    <div class="pagination-item">4</div>
                    <div class="pagination-item">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            @else
                <div class="bg-white p-8 rounded-lg shadow text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-plane-slash text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Tidak Ada Penerbangan</h3>
                    <p class="text-gray-600 mb-6">Maaf, tidak ada penerbangan yang tersedia untuk kriteria pencarian Anda.</p>
                    <button class="bg-red-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-red-700 transition-colors">
                        Cari Penerbangan Lain
                    </button>
                </div>
            @endif
        </div>
    </div>
</main>

<!-- Footer -->
<footer id="kontak" class="bg-gray-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-white p-1 rounded-lg">
                        <img src="{{ asset('images/singatanah-logo.png') }}" alt="Singa Tanah" class="h-8">
                    </div>
                    <span class="font-bold text-lg">Singa Tanah</span>
                </div>
                <p class="text-gray-400 mb-4">Maskapai penerbangan terkemuka di Indonesia yang melayani berbagai destinasi domestik dan internasional.</p>
                <div class="flex gap-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
            
            <div>
                <h3 class="font-semibold text-lg mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="#tentang-kami" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Karir</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Berita</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Syarat & Ketentuan</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="font-semibold text-lg mb-4">Layanan</h3>
                <ul class="space-y-2">
                    <li><a href="#penerbangan" class="text-gray-400 hover:text-white transition-colors">Penerbangan</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Status Penerbangan</a></li>
                    <li><a href="#bantuan" class="text-gray-400 hover:text-white transition-colors">Bantuan</a></li>
                    <li><a href="#kontak" class="text-gray-400 hover:text-white transition-colors">Hubungi Kami</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="font-semibold text-lg mb-4">Kontak</h3>
                <ul class="space-y-2">
                    <li class="flex items-center gap-2 text-gray-400">
                        <i class="fas fa-phone"></i>
                        <span>+62 21 6379 9000</span>
                    </li>
                    <li class="flex items-center gap-2 text-gray-400">
                        <i class="fas fa-envelope"></i>
                        <span>info@singatanah.co.id</span>
                    </li>
                    <li class="flex items-center gap-2 text-gray-400">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Jakarta, Indonesia</span>
                    </li>
                </ul>
                
                <div class="mt-6">
                    <h4 class="font-medium mb-2">Download Aplikasi</h4>
                    <div class="flex gap-2">
                        <a href="#" class="bg-gray-700 hover:bg-gray-600 transition-colors p-2 rounded-lg">
                            <i class="fab fa-google-play"></i>
                        </a>
                        <a href="#" class="bg-gray-700 hover:bg-gray-600 transition-colors p-2 rounded-lg">
                            <i class="fab fa-app-store"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; 2023 Singa Tanah. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Mobile Bottom Navigation -->
<div class="mobile-bottom-nav md:hidden">
    <a href="#beranda" class="mobile-nav-item active">
        <i class="fas fa-home mobile-nav-icon"></i>
        <span>Beranda</span>
    </a>
    <a href="#penerbangan" class="mobile-nav-item">
        <i class="fas fa-search mobile-nav-icon"></i>
        <span>Cari</span>
    </a>
    <a href="#" class="mobile-nav-item">
        <i class="fas fa-ticket-alt mobile-nav-icon"></i>
        <span>Pesanan</span>
    </a>
    <a href="#" class="mobile-nav-item">
        <i class="fas fa-user mobile-nav-icon"></i>
        <span>Profil</span>
    </a>
</div>

<!-- Floating Action Button -->
<div class="floating-action-button">
    <i class="fas fa-comments"></i>
</div>

<script>
  // toggle sederhana untuk profile dropdown
  (function () {
      const btn = document.getElementById('profileBtn');
      const menu = document.getElementById('profileMenu');
      if (!btn || !menu) return;
      
      document.addEventListener('click', function (e) {
          const target = e.target;
          if (btn.contains(target)) {
              // toggle
              menu.classList.toggle('hidden-on-load');
          } else {
              // klik di luar -> sembunyikan
              if (!menu.classList.contains('hidden-on-load')) menu.classList.add('hidden-on-load');
          }
      });
  })();
  
  // Mobile menu toggle
  (function () {
      const mobileMenuButton = document.getElementById('mobileMenuButton');
      const mobileMenu = document.getElementById('mobileMenu');
      
      if (mobileMenuButton && mobileMenu) {
          mobileMenuButton.addEventListener('click', function() {
              mobileMenu.classList.toggle('closed');
              mobileMenu.classList.toggle('open');
          });
          
          // Close mobile menu when clicking outside
          document.addEventListener('click', function(e) {
              if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                  mobileMenu.classList.add('closed');
                  mobileMenu.classList.remove('open');
              }
          });
      }
  })();
  
  // Flight details toggle
  (function () {
      const detailToggles = document.querySelectorAll('.flight-details-toggle');
      
      detailToggles.forEach(toggle => {
          toggle.addEventListener('click', function() {
              const flightItem = this.closest('.flight-list-item');
              const detailsContent = flightItem.querySelector('.flight-details-content');
              
              detailsContent.classList.toggle('open');
              
              if (detailsContent.classList.contains('open')) {
                  this.innerHTML = '<i class="fas fa-chevron-up"></i> Sembunyikan';
              } else {
                  this.innerHTML = '<i class="fas fa-info-circle"></i> Detail';
              }
          });
      });
  })();
  
  // Filter checkbox toggle
  (function () {
      const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
      
      filterCheckboxes.forEach(checkbox => {
          checkbox.addEventListener('click', function() {
              this.classList.toggle('checked');
          });
      });
  })();
  
  // Price range slider
  (function () {
      const priceInput = document.querySelector('.price-input');
      if (priceInput) {
          priceInput.addEventListener('input', function() {
              const value = (this.value - this.min) / (this.max - this.min) * 100;
              this.style.background = `linear-gradient(to right, #e11d48 0%, #e11d48 ${value}%, #e5e7eb ${value}%, #e5e7eb 100%)`;
          });
          
          // Trigger initial gradient
          priceInput.dispatchEvent(new Event('input'));
      }
  })();
  
  // Smooth scrolling for navigation links
  (function() {
      const navLinks = document.querySelectorAll('a[href^="#"]');
      
      navLinks.forEach(link => {
          link.addEventListener('click', function(e) {
              e.preventDefault();
              
              const targetId = this.getAttribute('href');
              if (targetId === '#') return;
              
              const targetElement = document.querySelector(targetId);
              if (targetElement) {
                  // Close mobile menu if open
                  const mobileMenu = document.getElementById('mobileMenu');
                  if (mobileMenu) {
                      mobileMenu.classList.add('closed');
                      mobileMenu.classList.remove('open');
                  }
                  
                  // Scroll to target
                  window.scrollTo({
                      top: targetElement.offsetTop - 80,
                      behavior: 'smooth'
                  });
              }
          });
      });
  })();
</script>

</body>
</html>