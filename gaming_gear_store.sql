-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 16, 2025 lúc 03:46 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gaming_gear_store`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `logo`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Logitech', 'logitech_logo.png', NULL, '2025-04-10 03:52:47', '2025-04-10 03:52:47'),
(2, 'Razer', 'razer_logo.png', NULL, '2025-04-10 03:52:47', '2025-04-10 03:52:47'),
(3, 'Corsair', 'corsair_logo.png', NULL, '2025-04-10 03:52:47', '2025-04-10 03:52:47'),
(4, 'SteelSeries', 'steelseries_logo.png', NULL, '2025-04-10 03:52:47', '2025-04-10 03:52:47'),
(5, 'HyperX', 'hyperx_logo.png', NULL, '2025-04-10 03:52:47', '2025-04-10 03:52:47'),
(7, 'ASUS', 'preview/image/brand/0aa1def3-3ddd-4dfb-9f03-15ab3d8fcad2.png', 'ASUS ROG Gaming Gear', '2025-04-10 07:49:12', '2025-04-10 07:49:12'),
(8, 'MadLion', 'preview/image/brand/869f4846-e0ad-4010-b5b1-c79ec054bb9c.png', 'MadLion chuyên sản xuất gaming gear đến từ Trung Quốc', '2025-04-10 23:59:51', '2025-04-10 23:59:51'),
(9, 'Ninjutso', 'preview/image/brand/506d5d49-825f-47cb-bf15-4ae11e3aaf52.png', 'ákdjha', '2025-04-11 03:45:52', '2025-04-11 03:49:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Bàn phím cơ', 'Bàn phím sử dụng switch cơ học cho cảm giác gõ tốt hơn', 'preview/image/category/f95145cc-525d-418f-a1b8-8298bde8c52c.jpg', '2025-04-10 03:52:47', '2025-04-10 02:28:09'),
(2, 'Chuột Gaming', 'Chuột thiết kế tối ưu cho game thủ, độ nhạy cao', 'mouse.jpg', '2025-04-10 03:52:47', '2025-04-10 03:52:47'),
(3, 'Tai nghe Gaming', 'Tai nghe chuyên dụng cho game, âm thanh vòm, mic tốt', 'headset.jpg', '2025-04-10 03:52:47', '2025-04-10 03:52:47'),
(4, 'Lót chuột', 'Bàn di chuột kích thước lớn, bề mặt tối ưu', 'mousepad.jpg', '2025-04-10 03:52:47', '2025-04-10 03:52:47'),
(5, 'Ghế Gaming', 'Ghế thiết kế công thái học cho game thủ', 'gaming_chair.jpg', '2025-04-10 03:52:47', '2025-04-10 03:52:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'new',
  `replied_at` timestamp NULL DEFAULT NULL,
  `replied_by_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `status`, `replied_at`, `replied_by_user_id`, `created_at`, `updated_at`) VALUES
(2, 'Người test', 'michaelleon3310@gmail.com', 'test', 'test', 'replied', '2025-04-12 11:17:07', 1, '2025-04-12 11:07:03', '2025-04-12 11:17:07'),
(3, 'Admin User', 'Khoatran3123@gmail.com', 'test', '<?php\r\nnamespace App\\Mail;\r\nuse App\\Models\\Contact; // <<< Import Contact\r\nuse Illuminate\\Bus\\Queueable;\r\nuse Illuminate\\Contracts\\Queue\\ShouldQueue;\r\nuse Illuminate\\Mail\\Mailable;\r\nuse Illuminate\\Mail\\Mailables\\Content;\r\nuse Illuminate\\Mail\\Mailables\\Envelope;\r\nuse Illuminate\\Queue\\SerializesModels;\r\nuse Illuminate\\Mail\\Mailables\\Address;\r\n\r\nclass ContactReplyMail extends Mailable \r\n{\r\n    use Queueable, SerializesModels;\r\n\r\n    public Contact $originalContact; \r\n    public string $replySubject;     \r\n    public string $replyMessage;     \r\n\r\n    public function __construct(Contact $originalContact, string $replySubject, string $replyMessage)\r\n    {\r\n        $this->originalContact = $originalContact;\r\n        $this->replySubject = $replySubject;\r\n        $this->replyMessage = $replyMessage;\r\n    }\r\n\r\n    public function envelope(): Envelope\r\n    {\r\n        return new Envelope(\r\n            from: new Address(config(\'mail.from.address\'), config(\'mail.from.name\')),\r\n            replyTo: [ new Address($this->originalContact->email, $this->originalContact->name) ],\r\n            subject: $this->replySubject, \r\n        );\r\n    }\r\n\r\n    public function content(): Content\r\n    {\r\n        return new Content(\r\n            view: \'emails.contact.reply\', \r\n           \r\n            with: [\r\n                \'originalSubject\' => $this->originalContact->subject,\r\n                \'originalMessage\' => $this->originalContact->message,\r\n                \'replyMessageContent\' => $this->replyMessage, \r\n            ],\r\n        );\r\n    }\r\n    public function attachments(): array { return []; }\r\n}', 'replied', '2025-04-12 11:37:19', 1, '2025-04-12 11:10:00', '2025-04-12 11:37:19'),
(4, 'Nguyễn Trần Viết Khoa', 'michaelleon3310@gmail.com', 'test', 'test liên hệ', 'replied', '2025-04-15 06:00:52', 1, '2025-04-15 05:04:21', '2025-04-15 06:00:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(29, 'default', '{\"uuid\":\"8cdf3867-62f9-441b-97fd-88f1dfdd123e\",\"displayName\":\"App\\\\Mail\\\\OrderPlaced\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\OrderPlaced\\\":3:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:3:{i:0;s:4:\\\"user\\\";i:1;s:12:\\\"orderDetails\\\";i:2;s:20:\\\"orderDetails.product\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"khoa6789k@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744394817, 1744394817),
(30, 'default', '{\"uuid\":\"488b937b-7841-4f88-a985-32b46e79d1a0\",\"displayName\":\"App\\\\Mail\\\\OrderStatusUpdated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:27:\\\"App\\\\Mail\\\\OrderStatusUpdated\\\":4:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:3:{i:0;s:4:\\\"user\\\";i:1;s:12:\\\"orderDetails\\\";i:2;s:20:\\\"orderDetails.product\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:13:\\\"newStatusText\\\";s:22:\\\"Mới (Chờ xử lý)\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"khoa6789k@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744394817, 1744394817),
(31, 'default', '{\"uuid\":\"9447b2b1-8a12-4cef-b06b-3e3e0e8026f3\",\"displayName\":\"App\\\\Mail\\\\OrderPlaced\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\OrderPlaced\\\":3:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:3:{i:0;s:4:\\\"user\\\";i:1;s:12:\\\"orderDetails\\\";i:2;s:20:\\\"orderDetails.product\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"khoa6789k@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744394828, 1744394828),
(32, 'default', '{\"uuid\":\"0521987a-1e99-4fdf-8f7b-115adfc78936\",\"displayName\":\"App\\\\Mail\\\\OrderStatusUpdated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:27:\\\"App\\\\Mail\\\\OrderStatusUpdated\\\":4:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:3:{i:0;s:4:\\\"user\\\";i:1;s:12:\\\"orderDetails\\\";i:2;s:20:\\\"orderDetails.product\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:13:\\\"newStatusText\\\";s:14:\\\"Đang xử lý\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"khoa6789k@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744394828, 1744394828),
(33, 'default', '{\"uuid\":\"dfb6cc34-397e-4cf0-9b4d-417d9d4af25b\",\"displayName\":\"App\\\\Mail\\\\OrderPlaced\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\OrderPlaced\\\":3:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:3:{i:0;s:4:\\\"user\\\";i:1;s:12:\\\"orderDetails\\\";i:2;s:20:\\\"orderDetails.product\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"khoa6789k@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744394848, 1744394848),
(34, 'default', '{\"uuid\":\"5d12c714-4302-4aa7-b3d2-029d3dcea8fe\",\"displayName\":\"App\\\\Mail\\\\OrderStatusUpdated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:27:\\\"App\\\\Mail\\\\OrderStatusUpdated\\\":4:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:3:{i:0;s:4:\\\"user\\\";i:1;s:12:\\\"orderDetails\\\";i:2;s:20:\\\"orderDetails.product\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:13:\\\"newStatusText\\\";s:16:\\\"Đang giao hàng\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"khoa6789k@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744394848, 1744394848),
(35, 'default', '{\"uuid\":\"9959ab2d-06c9-4a98-a800-3643e5cb344d\",\"displayName\":\"App\\\\Mail\\\\ContactReplyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:25:\\\"App\\\\Mail\\\\ContactReplyMail\\\":5:{s:15:\\\"originalContact\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Contact\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"replySubject\\\";s:52:\\\"Re: Làm sao để làm chức năng liên hệ ạ?\\\";s:12:\\\"replyMessage\\\";s:75:\\\"Chào bạn, tôi nghĩ là bạn đã làm được rồi đó, ngầu vcl\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"michaelleon3310@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744480863, 1744480863),
(36, 'default', '{\"uuid\":\"c11a164c-c5d9-4035-97cc-d7a3ed4a8094\",\"displayName\":\"App\\\\Mail\\\\ContactReplyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:25:\\\"App\\\\Mail\\\\ContactReplyMail\\\":5:{s:15:\\\"originalContact\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Contact\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"replySubject\\\";s:52:\\\"Re: Làm sao để làm chức năng liên hệ ạ?\\\";s:12:\\\"replyMessage\\\";s:3:\\\"ád\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"michaelleon3310@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744480947, 1744480947),
(37, 'default', '{\"uuid\":\"9f7b8ce9-42b9-4c60-aea8-f872e646f994\",\"displayName\":\"App\\\\Mail\\\\ContactReplyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:25:\\\"App\\\\Mail\\\\ContactReplyMail\\\":5:{s:15:\\\"originalContact\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Contact\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"replySubject\\\";s:52:\\\"Re: Làm sao để làm chức năng liên hệ ạ?\\\";s:12:\\\"replyMessage\\\";s:5:\\\"ádas\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"michaelleon3310@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744480963, 1744480963),
(38, 'default', '{\"uuid\":\"abbd0d12-5a42-40cf-bfb5-6adce05b734f\",\"displayName\":\"App\\\\Mail\\\\ContactReplyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:25:\\\"App\\\\Mail\\\\ContactReplyMail\\\":5:{s:15:\\\"originalContact\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Contact\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"replySubject\\\";s:52:\\\"Re: Làm sao để làm chức năng liên hệ ạ?\\\";s:12:\\\"replyMessage\\\";s:4:\\\"test\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"michaelleon3310@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744481058, 1744481058),
(39, 'default', '{\"uuid\":\"72902f76-bf11-463c-8c78-025c65bc9595\",\"displayName\":\"App\\\\Mail\\\\ContactReplyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:25:\\\"App\\\\Mail\\\\ContactReplyMail\\\":5:{s:15:\\\"originalContact\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Contact\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"replySubject\\\";s:52:\\\"Re: Làm sao để làm chức năng liên hệ ạ?\\\";s:12:\\\"replyMessage\\\";s:10:\\\"test lại\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"michaelleon3310@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744481134, 1744481134),
(40, 'default', '{\"uuid\":\"918be10a-571b-4722-b01d-962bb0d2436a\",\"displayName\":\"App\\\\Mail\\\\ContactReplyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:25:\\\"App\\\\Mail\\\\ContactReplyMail\\\":5:{s:15:\\\"originalContact\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Contact\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"replySubject\\\";s:8:\\\"Re: test\\\";s:12:\\\"replyMessage\\\";s:6:\\\"ádasd\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"michaelleon3310@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744481240, 1744481240),
(41, 'default', '{\"uuid\":\"b61e5807-493c-4f3c-827a-47a0f04fcf2b\",\"displayName\":\"App\\\\Mail\\\\ContactReplyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:25:\\\"App\\\\Mail\\\\ContactReplyMail\\\":5:{s:15:\\\"originalContact\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Contact\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"replySubject\\\";s:8:\\\"Re: test\\\";s:12:\\\"replyMessage\\\";s:4:\\\"jgfh\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"michaelleon3310@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744481341, 1744481341),
(42, 'default', '{\"uuid\":\"d5eddc4b-2b83-4145-9c9a-fb1968a7ce30\",\"displayName\":\"App\\\\Mail\\\\ContactReplyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:25:\\\"App\\\\Mail\\\\ContactReplyMail\\\":5:{s:15:\\\"originalContact\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Contact\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"replySubject\\\";s:8:\\\"Re: test\\\";s:12:\\\"replyMessage\\\";s:6:\\\"qưeqw\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:22:\\\"Khoatran3123@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744481414, 1744481414),
(43, 'default', '{\"uuid\":\"f3dac3bf-36f2-4f7c-b8d9-3df9b952f228\",\"displayName\":\"App\\\\Mail\\\\ContactReplyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:25:\\\"App\\\\Mail\\\\ContactReplyMail\\\":5:{s:15:\\\"originalContact\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Contact\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"replySubject\\\";s:8:\\\"Re: test\\\";s:12:\\\"replyMessage\\\";s:4:\\\"tét\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:22:\\\"Khoatran3123@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744481648, 1744481648),
(44, 'default', '{\"uuid\":\"aaf00e11-becd-4726-b0e7-dc48ebcd64ed\",\"displayName\":\"App\\\\Mail\\\\ContactReplyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:25:\\\"App\\\\Mail\\\\ContactReplyMail\\\":5:{s:15:\\\"originalContact\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Contact\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"replySubject\\\";s:8:\\\"Re: test\\\";s:12:\\\"replyMessage\\\";s:7:\\\"fsfsdfs\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:22:\\\"Khoatran3123@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744481707, 1744481707),
(45, 'default', '{\"uuid\":\"ddb7b7fe-a52d-44a4-b87a-67e7b02323ef\",\"displayName\":\"App\\\\Mail\\\\ContactReplyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:25:\\\"App\\\\Mail\\\\ContactReplyMail\\\":5:{s:15:\\\"originalContact\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Contact\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"replySubject\\\";s:8:\\\"Re: test\\\";s:12:\\\"replyMessage\\\";s:6:\\\"đâsd\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:22:\\\"Khoatran3123@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744481750, 1744481750),
(46, 'default', '{\"uuid\":\"f9b0bbf5-0a46-4cdd-942e-1d5c8d2eb12b\",\"displayName\":\"App\\\\Mail\\\\ContactReplyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:25:\\\"App\\\\Mail\\\\ContactReplyMail\\\":5:{s:15:\\\"originalContact\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Contact\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"replySubject\\\";s:8:\\\"Re: test\\\";s:12:\\\"replyMessage\\\";s:8:\\\"ádasdas\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"michaelleon3310@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1744481827, 1744481827),
(47, 'default', '{\"uuid\":\"09b48ac9-ead8-444e-820b-a71a4bff22fd\",\"displayName\":\"App\\\\Notifications\\\\CustomResetPasswordNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:10;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:49:\\\"App\\\\Notifications\\\\CustomResetPasswordNotification\\\":2:{s:5:\\\"token\\\";s:64:\\\"ab9ff343e78f9447d44f83699dfc84e56b68feff3034762e00efae28f635227c\\\";s:2:\\\"id\\\";s:36:\\\"bf249578-ff22-466a-9ca6-5e6218f75b2c\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1744618252, 1744618252),
(48, 'default', '{\"uuid\":\"582ffa0e-58ea-4ac8-aadc-ac375653f736\",\"displayName\":\"App\\\\Notifications\\\\CustomResetPasswordNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:49:\\\"App\\\\Notifications\\\\CustomResetPasswordNotification\\\":2:{s:5:\\\"token\\\";s:64:\\\"b75f777e0e08cc91f4a91ac5e38c470bf62e8c69cfb52a366c5535258a9118b1\\\";s:2:\\\"id\\\";s:36:\\\"554a4db6-33fa-4d00-b474-73bd6daf9e05\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1744618278, 1744618278),
(49, 'default', '{\"uuid\":\"af0e364e-c622-4cba-b79c-f359cb26c857\",\"displayName\":\"App\\\\Notifications\\\\CustomResetPasswordNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:10;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:49:\\\"App\\\\Notifications\\\\CustomResetPasswordNotification\\\":2:{s:5:\\\"token\\\";s:64:\\\"0022df63710b171503f2ecdd7fd4cb89f59b271542e0a5b31cf04858824fa540\\\";s:2:\\\"id\\\";s:36:\\\"c2a730c2-59a7-4169-976e-87a9f91b868e\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1744619372, 1744619372),
(50, 'default', '{\"uuid\":\"67a48aaa-0c26-4190-b72f-20f5285622ca\",\"displayName\":\"App\\\\Notifications\\\\CustomResetPasswordNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:49:\\\"App\\\\Notifications\\\\CustomResetPasswordNotification\\\":2:{s:5:\\\"token\\\";s:64:\\\"85dcd7da59d7f4873766100de7e345e5f773dd83dc47c4caab1761b9d5e2ea92\\\";s:2:\\\"id\\\";s:36:\\\"72357328-7ffb-49dd-8a35-1cdf1aea661b\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1744619408, 1744619408);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_10_151740_add_avatar_to_users_table', 2),
(5, '2025_04_11_145827_add_updated_at_to_wishlists_table', 3),
(6, '2025_04_12_173358_create_contacts_table', 4),
(7, '2025_04_14_054221_create_password_reset_tokens_table', 5),
(8, '2025_04_14_164032_add_code_to_orders_table', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'Tiêu đề',
  `content` longtext NOT NULL COMMENT 'Nội dung',
  `image` varchar(255) DEFAULT NULL COMMENT 'Hình ảnh đại diện',
  `author_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'ID người viết (liên kết tới users)',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Trạng thái (1=Published, 0=Draft)',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `author_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Top 5 bàn phím cơ đáng mua nhất 2025', 'Nội dung bài viết về top 5 bàn phím...', 'top5keyboard.jpg', 1, 1, '2025-04-10 03:52:47', '2025-04-10 03:52:47'),
(2, 'AOC G42E Series 24G42E và 27G42E: Màn hình IPS tần số quét cao 180Hz, chinh phục mọi tựa game', 'AOC G42E Series 24G42E và 27G42E: Màn hình IPS tần số quét cao 180Hz, chinh phục mọi tựa game', 'preview/image/news/38bb873a-64db-43f4-b10f-4fde699a99d3.webp', 1, 1, '2025-04-10 09:59:59', '2025-04-10 10:03:12'),
(3, 'Trải nghiệm cặp đôi hoàn hảo nhà Razer - lựa chọn tối ưu để chinh phục các trận đấu đỉnh cao', 'Trải nghiệm cặp đôi hoàn hảo nhà Razer - lựa chọn tối ưu để chinh phục các trận đấu đỉnh cao', 'preview/image/news/4d591cc5-0764-4312-b75c-0704bce9311c.webp', 1, 1, '2025-04-10 10:01:02', '2025-04-10 10:01:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'ID người dùng (nếu đã đăng nhập)',
  `customer_name` varchar(100) NOT NULL COMMENT 'Tên người nhận hàng',
  `customer_email` varchar(100) NOT NULL COMMENT 'Email người nhận',
  `customer_phone` varchar(20) NOT NULL COMMENT 'SĐT người nhận',
  `shipping_address` varchar(255) NOT NULL COMMENT 'Địa chỉ giao hàng',
  `order_date` timestamp NULL DEFAULT current_timestamp() COMMENT 'Ngày đặt hàng',
  `total_amount` decimal(15,2) DEFAULT NULL COMMENT 'Tổng tiền hàng (chưa gồm ship, giảm giá)',
  `shipping_fee` decimal(15,2) DEFAULT 0.00 COMMENT 'Phí vận chuyển',
  `discount_amount` decimal(15,2) DEFAULT 0.00 COMMENT 'Số tiền được giảm (voucher, etc.)',
  `final_amount` decimal(15,2) DEFAULT NULL COMMENT 'Tổng tiền cuối cùng phải trả',
  `payment_method` varchar(50) DEFAULT NULL COMMENT 'Hình thức thanh toán (COD, Bank Transfer, Momo...)',
  `payment_status` varchar(50) NOT NULL DEFAULT 'unpaid' COMMENT 'Trạng thái thanh toán (unpaid, paid, failed)',
  `shipping_status` varchar(50) NOT NULL DEFAULT 'pending' COMMENT 'Trạng thái giao hàng (pending, processing, shipped, delivered, cancelled)',
  `note` text DEFAULT NULL COMMENT 'Ghi chú của khách hàng',
  `admin_note` text DEFAULT NULL COMMENT 'Ghi chú của quản trị viên',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `code`, `user_id`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `order_date`, `total_amount`, `shipping_fee`, `discount_amount`, `final_amount`, `payment_method`, `payment_status`, `shipping_status`, `note`, `admin_note`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 'Regular Customer', 'Khoatran3123@gmail.com', '0987654321', '456 User Avenue', '2025-04-10 03:52:47', 3290000.00, 30000.00, 0.00, 3320000.00, 'COD', 'unpaid', 'delivered', 'Giao hàng giờ hành chính', NULL, '2025-04-10 03:52:47', '2025-04-11 11:35:27'),
(17, NULL, 1, 'Admin User', 'Khoatran3123@gmail.com', '0123456789', '123 Admin Street', '2025-04-11 18:30:10', 690000.00, 30000.00, 0.00, 720000.00, 'COD', 'unpaid', 'processing', NULL, NULL, '2025-04-11 11:30:10', '2025-04-11 11:46:08'),
(18, NULL, 1, 'Admin User', 'Khoatran3123@gmail.com', '0123456789', '123 Admin Street', '2025-04-11 18:50:24', 2490000.00, 30000.00, 0.00, 2520000.00, 'COD', 'unpaid', 'processing', NULL, NULL, '2025-04-11 11:50:24', '2025-04-12 10:39:12'),
(19, NULL, 1, 'Admin User', 'Khoatran3123@gmail.com', '0123456789', '123 Admin Street', '2025-04-12 18:09:31', 690000.00, 30000.00, 0.00, 720000.00, 'COD', 'unpaid', 'pending', NULL, NULL, '2025-04-12 11:09:31', '2025-04-12 11:09:31'),
(20, NULL, 10, 'Người test222', 'michaelleon3310@gmail.com', '0385750387', '22 Marion Ave Millbury, Massachusetts(MA)', '2025-04-13 09:14:25', 5590000.00, 30000.00, 0.00, 5620000.00, 'BankTransfer', 'unpaid', 'delivered', 'test', NULL, '2025-04-13 02:14:25', '2025-04-13 02:43:44'),
(21, NULL, 10, 'Người test222', 'michaelleon3310@gmail.com', '0385750387', '22 Marion Ave Millbury, Massachusetts(MA)', '2025-04-13 16:15:43', 1990000.00, 30000.00, 0.00, 2020000.00, 'COD', 'paid', 'delivered', NULL, NULL, '2025-04-13 09:15:43', '2025-04-13 09:20:07'),
(22, NULL, NULL, 'hoi an', 'Khoatran3123@gmail.com', '0385750387', 'fsdfs', '2025-04-14 02:17:06', 4900000.00, 30000.00, 0.00, 4930000.00, 'COD', 'unpaid', 'pending', 'test', NULL, '2025-04-13 19:17:06', '2025-04-13 19:17:06'),
(23, 'ORD-20250414-000023', 1, 'Admin User', 'Khoatran3123@gmail.com', '0123456789', '123 Admin Street', '2025-04-14 16:51:22', 8190000.00, 30000.00, 0.00, 8220000.00, 'COD', 'paid', 'delivered', NULL, NULL, '2025-04-14 09:51:22', '2025-04-14 19:49:16'),
(24, 'ORD-20250415-000024', 10, 'Nguyễn trần Viết Khoa', 'michaelleon3310@gmail.com', '0385750387', '22 Marion Ave Millbury, Massachusetts(MA)', '2025-04-15 09:33:33', 17430000.00, 30000.00, 0.00, 17460000.00, 'COD', 'unpaid', 'shipped', 'Giao đến nhớ lộn 3 vòng rồi cắt kéo 1p giúp em nha', NULL, '2025-04-15 02:33:33', '2025-04-15 06:21:14'),
(25, 'ORD-20250416-000025', 10, 'Viết Khoa1', 'michaelleon3310@gmail.com', '0385750387', 'Tổ 34 Khuê Mỹ', '2025-04-16 01:12:33', 35040000.00, 30000.00, 0.00, 35070000.00, 'BankTransfer', 'unpaid', 'processing', 'test', NULL, '2025-04-15 18:12:33', '2025-04-15 18:13:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID sản phẩm (có thể NULL nếu sản phẩm bị xóa)',
  `product_name` varchar(255) NOT NULL COMMENT 'Tên sản phẩm tại thời điểm mua',
  `quantity` int(11) NOT NULL COMMENT 'Số lượng',
  `price` decimal(15,2) NOT NULL COMMENT 'Đơn giá tại thời điểm mua',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Logitech G Pro X Superlight', 1, 3290000.00, '2025-04-10 03:52:47', '2025-04-10 03:52:47'),
(17, 17, 8, 'Tấm lót chuột Steelseries QCK Heavy Large MousePad', 1, 690000.00, '2025-04-11 18:30:10', '2025-04-11 18:30:10'),
(18, 18, 7, 'Chuột không dây siêu nhẹ Ninjutso Sora - Đen', 1, 2490000.00, '2025-04-11 18:50:24', '2025-04-11 18:50:24'),
(19, 19, 8, 'Tấm lót chuột Steelseries QCK Heavy Large MousePad', 1, 690000.00, '2025-04-12 18:09:31', '2025-04-12 18:09:31'),
(20, 20, 12, 'Ghế Corsair TC100 Fabric Black Grey CF-9010052-WW', 1, 4900000.00, '2025-04-13 09:14:25', '2025-04-13 09:14:25'),
(21, 20, 8, 'Tấm lót chuột Steelseries QCK Heavy Large MousePad', 1, 690000.00, '2025-04-13 09:14:25', '2025-04-13 09:14:25'),
(22, 21, 3, 'HyperX Cloud II', 1, 1990000.00, '2025-04-13 16:15:43', '2025-04-13 16:15:43'),
(23, 22, 12, 'Ghế Corsair TC100 Fabric Black Grey CF-9010052-WW', 1, 4900000.00, '2025-04-14 02:17:06', '2025-04-14 02:17:06'),
(24, 23, 11, 'Ghế Corsair TC200 Soft Fabric – Black/Black', 1, 8190000.00, '2025-04-14 16:51:22', '2025-04-14 16:51:22'),
(25, 24, 7, 'Chuột không dây siêu nhẹ Ninjutso Sora - Đen', 7, 2490000.00, '2025-04-15 09:33:33', '2025-04-15 09:33:33'),
(26, 25, 11, 'Ghế Corsair TC200 Soft Fabric – Black/Black', 3, 8190000.00, '2025-04-16 01:12:34', '2025-04-16 01:12:34'),
(27, 25, 9, 'Tai nghe HP HyperX Cloud III Wireless Red', 3, 3490000.00, '2025-04-16 01:12:34', '2025-04-16 01:12:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('Khoatran3123@gmail.com', '$2y$12$DecRB0eXG3NaousXcEyjnOW7H20gG5CXcrdXZ4eA0Ex6S8XKz1XR6', '2025-04-15 06:43:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL COMMENT 'Mô tả chi tiết sản phẩm',
  `specifications` text DEFAULT NULL COMMENT 'Thông số kỹ thuật (có thể dùng JSON)',
  `price` decimal(15,2) DEFAULT NULL COMMENT 'Giá gốc',
  `discount_price` decimal(15,2) DEFAULT NULL COMMENT 'Giá sau khi giảm (nếu có)',
  `stock_quantity` int(11) NOT NULL DEFAULT 0 COMMENT 'Số lượng tồn kho',
  `image` varchar(255) DEFAULT NULL COMMENT 'Ảnh đại diện sản phẩm',
  `gallery` text DEFAULT NULL COMMENT 'Bộ sưu tập ảnh (có thể dùng JSON lưu danh sách tên file)',
  `unit` varchar(50) DEFAULT 'cái' COMMENT 'Đơn vị tính',
  `is_new` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Sản phẩm mới (1=Có, 0=Không)',
  `is_featured` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Sản phẩm nổi bật (1=Có, 0=Không)',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Trạng thái (1=Đang bán, 0=Ngừng bán)',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `brand_id`, `description`, `specifications`, `price`, `discount_price`, `stock_quantity`, `image`, `gallery`, `unit`, `is_new`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Logitech G Pro X Superlight', 2, 1, 'Chuột gaming không dây siêu nhẹ', '\"{\\r\\n  \\\"T\\u00ean s\\u1ea3n ph\\u1ea9m\\\": \\\"Logitech G Pro X Superlight\\\",\\r\\n  \\\"Lo\\u1ea1i s\\u1ea3n ph\\u1ea9m\\\": \\\"Chu\\u1ed9t ch\\u01a1i game kh\\u00f4ng d\\u00e2y\\\",\\r\\n  \\\"C\\u1ea3m bi\\u1ebfn\\\": \\\"HERO 25K\\\",\\r\\n  \\\"\\u0110\\u1ed9 nh\\u1ea1y DPI\\\": \\\"100 - 25,600 DPI\\\",\\r\\n  \\\"T\\u1ed1c \\u0111\\u1ed9 ph\\u1ea3n h\\u1ed3i\\\": \\\"1 ms (1000 Hz)\\\",\\r\\n  \\\"Tr\\u1ecdng l\\u01b0\\u1ee3ng\\\": \\\"63 gram\\\",\\r\\n  \\\"K\\u00edch th\\u01b0\\u1edbc\\\": {\\r\\n    \\\"Chi\\u1ec1u d\\u00e0i\\\": \\\"125 mm\\\",\\r\\n    \\\"Chi\\u1ec1u r\\u1ed9ng\\\": \\\"63.5 mm\\\",\\r\\n    \\\"Chi\\u1ec1u cao\\\": \\\"40 mm\\\"\\r\\n  },\\r\\n  \\\"Pin\\\": \\\"C\\u00f3 th\\u1ec3 s\\u1ea1c l\\u1ea1i, th\\u1eddi l\\u01b0\\u1ee3ng l\\u00ean \\u0111\\u1ebfn 70 gi\\u1edd\\\",\\r\\n  \\\"K\\u1ebft n\\u1ed1i\\\": \\\"Kh\\u00f4ng d\\u00e2y LIGHTSPEED\\\",\\r\\n  \\\"M\\u00e0u s\\u1eafc\\\": [\\\"\\u0110en\\\", \\\"Tr\\u1eafng\\\"],\\r\\n  \\\"N\\u00fat b\\u1ea5m\\\": \\\"5 n\\u00fat c\\u00f3 th\\u1ec3 l\\u1eadp tr\\u00ecnh\\\",\\r\\n  \\\"T\\u00ednh n\\u0103ng \\u0111\\u1eb7c bi\\u1ec7t\\\": \\\"Thi\\u1ebft k\\u1ebf si\\u00eau nh\\u1eb9, ch\\u00e2n PTFE kh\\u00f4ng ma s\\u00e1t\\\"\\r\\n}\"', 3500000.00, 3290000.00, 44, 'pro_x_superlight.jpg', NULL, 'cái', 1, 1, 1, '2025-04-10 03:52:47', '2025-04-11 10:16:20'),
(2, 'Razer BlackWidow V3', 1, 2, 'Bàn phím cơ fullsize, switch Razer Green', '\"{\\r\\n\\\"T\\u00ean s\\u1ea3n ph\\u1ea9m\\\": \\\"Razer BlackWidow V3\\\",\\r\\n\\\"T\\u00ednh n\\u0103ng n\\u1ed5i b\\u1eadt\\\": [\\r\\n\\\"Switch c\\u01a1 h\\u1ecdc Razer Green ho\\u1eb7c Razer Yellow cho c\\u1ea3m gi\\u00e1c g\\u00f5 nh\\u1ea1y v\\u00e0 ch\\u00ednh x\\u00e1c\\\",\\r\\n\\\"\\u0110\\u00e8n n\\u1ec1n Razer Chroma RGB v\\u1edbi kh\\u1ea3 n\\u0103ng t\\u00f9y ch\\u1ec9nh 16.8 tri\\u1ec7u m\\u00e0u, t\\u1ea1o hi\\u1ec7u \\u1ee9ng \\u00e1nh s\\u00e1ng s\\u1ed1ng \\u0111\\u1ed9ng\\\",\\r\\n\\\"Khung nh\\u00f4m ch\\u1eafc ch\\u1eafn, \\u0111\\u1ea3m b\\u1ea3o \\u0111\\u1ed9 b\\u1ec1n v\\u00e0 s\\u1ef1 \\u1ed5n \\u0111\\u1ecbnh\\\",\\r\\n\\\"Keycap ABS v\\u1edbi l\\u1edbp ph\\u1ee7 UV ch\\u1ed1ng m\\u00e0i m\\u00f2n, t\\u0103ng \\u0111\\u1ed9 b\\u1ec1n cho ph\\u00edm\\\",\\r\\n\\\"Ph\\u00edm media chuy\\u00ean d\\u1ee5ng v\\u00e0 n\\u00fam xoay \\u0111a ch\\u1ee9c n\\u0103ng, ti\\u1ec7n l\\u1ee3i cho \\u0111i\\u1ec1u ch\\u1ec9nh \\u00e2m thanh v\\u00e0 c\\u00e1c t\\u00ednh n\\u0103ng kh\\u00e1c\\\"\\r\\n],\\r\\n\\\"\\u0110\\u1ed9 b\\u1ec1n\\\": \\\"Cao, ch\\u1ecbu l\\u1ef1c t\\u1ed1t, th\\u00edch h\\u1ee3p cho s\\u1eed d\\u1ee5ng l\\u00e2u d\\u00e0i\\\",\\r\\n\\\"K\\u1ebft n\\u1ed1i\\\": \\\"C\\u1ed5ng USB, \\u0111\\u1ea3m b\\u1ea3o t\\u1ed1c \\u0111\\u1ed9 truy\\u1ec1n d\\u1eef li\\u1ec7u nhanh v\\u00e0 \\u1ed5n \\u0111\\u1ecbnh\\\",\\r\\n\\\"T\\u01b0\\u01a1ng th\\u00edch\\\": [\\r\\n\\\"Windows, h\\u1ed7 tr\\u1ee3 \\u0111\\u1ea7y \\u0111\\u1ee7 c\\u00e1c phi\\u00ean b\\u1ea3n\\\",\\r\\n\\\"macOS, t\\u01b0\\u01a1ng th\\u00edch t\\u1ed1t v\\u1edbi h\\u1ec7 \\u0111i\\u1ec1u h\\u00e0nh c\\u1ee7a Apple\\\"\\r\\n],\\r\\n\\\"\\u0110\\u1ed1i t\\u01b0\\u1ee3ng s\\u1eed d\\u1ee5ng\\\": [\\r\\n\\\"Game th\\u1ee7, mang l\\u1ea1i tr\\u1ea3i nghi\\u1ec7m ch\\u01a1i game m\\u01b0\\u1ee3t m\\u00e0\\\",\\r\\n\\\"Ng\\u01b0\\u1eddi y\\u00eau c\\u00f4ng ngh\\u1ec7, ph\\u00f9 h\\u1ee3p v\\u1edbi nh\\u1eefng ai \\u0111am m\\u00ea s\\u1ea3n ph\\u1ea9m ch\\u1ea5t l\\u01b0\\u1ee3ng cao\\\"\\r\\n]\\r\\n}\"', 2800000.00, NULL, 28, 'blackwidow_v3.jpg', NULL, 'cái', 0, 1, 1, '2025-04-10 03:52:47', '2025-04-11 11:11:48'),
(3, 'HyperX Cloud II', 3, 5, 'Tai nghe gaming âm thanh vòm 7.1', '\"{\\r\\n  \\\"ten_san_pham\\\": \\\"HyperX Cloud II\\\",\\r\\n  \\\"loai\\\": \\\"Tai nghe ch\\u01a1i game\\\",\\r\\n  \\\"ket_noi\\\": \\\"USB, 3.5mm\\\",\\r\\n  \\\"trong_luong\\\": \\\"320g\\\",\\r\\n  \\\"dai_tai_nghe\\\": \\\"53mm\\\",\\r\\n  \\\"tan_so\\\": \\\"15Hz\\u201325kHz\\\",\\r\\n  \\\"tro_khang\\\": \\\"60 Ohm\\\",\\r\\n  \\\"do_nhay\\\": \\\"98\\u00b13dB\\\",\\r\\n  \\\"micro\\\": {\\r\\n    \\\"loai\\\": \\\"Condenser\\\",\\r\\n    \\\"tan_so\\\": \\\"50Hz\\u201318kHz\\\",\\r\\n    \\\"do_nhay\\\": \\\"-39\\u00b13dB\\\"\\r\\n  },\\r\\n  \\\"am_thanh\\\": \\\"7.1 Surround Sound\\\",\\r\\n  \\\"chat_lieu\\\": \\\"Nh\\u00f4m, nh\\u1ef1a, da nh\\u00e2n t\\u1ea1o\\\",\\r\\n  \\\"mau_sac\\\": \\\"\\u0110\\u1ecf\\/\\u0110en\\\"\\r\\n}\"', 2200000.00, 1990000.00, 99, 'cloud_ii.jpg', NULL, 'cái', 0, 0, 1, '2025-04-10 03:52:47', '2025-04-13 09:15:43'),
(5, 'Chuột Logitech G Pro X Superlight 2 Dex Wireless Pink', 2, 1, 'Chuột Logitech G Pro X Superlight 2 Dex Wireless Pink là một sản phẩm nổi bật trong dòng chuột chơi game với thiết kế tối giản nhưng đầy tinh tế. Được trang bị công nghệ không dây tiên tiến, chuột này mang lại sự tự do di chuyển tối đa cho người dùng mà không lo bị gián đoạn. Với trọng lượng siêu nhẹ, chỉ khoảng 63 gram, Logitech G Pro X Superlight 2 giúp giảm thiểu mỏi tay khi sử dụng trong thời gian dài.\r\n\r\nSở hữu cảm biến HERO 25K, chuột cung cấp độ chính xác tuyệt đối và tốc độ phản hồi nhanh chóng, phù hợp cho các game thủ chuyên nghiệp. Ngoài ra, thiết kế màu hồng bắt mắt không chỉ thể hiện phong cách độc đáo mà còn làm nổi bật không gian làm việc hoặc chơi game của bạn. Các nút bấm được bố trí hợp lý, mang lại cảm giác bấm thoải mái và chính xác.\r\n\r\nLogitech G Pro X Superlight 2 Dex Wireless Pink là lựa chọn hoàn hảo cho những ai tìm kiếm một sản phẩm chuột chơi game chất lượng cao, vừa tiện lợi vừa phong cách.', '\"{\\r\\n  \\\"T\\u00ean s\\u1ea3n ph\\u1ea9m\\\": \\\"Chu\\u1ed9t Logitech G Pro X Superlight 2 Dex Wireless Pink\\\",\\r\\n  \\\"Lo\\u1ea1i k\\u1ebft n\\u1ed1i\\\": \\\"Wireless\\\",\\r\\n  \\\"M\\u00e0u s\\u1eafc\\\": \\\"H\\u1ed3ng\\\",\\r\\n  \\\"C\\u1ea3m bi\\u1ebfn\\\": \\\"Hero 25K\\\",\\r\\n  \\\"\\u0110\\u1ed9 ph\\u00e2n gi\\u1ea3i t\\u1ed1i \\u0111a\\\": \\\"25600 DPI\\\",\\r\\n  \\\"Tr\\u1ecdng l\\u01b0\\u1ee3ng\\\": \\\"63g\\\",\\r\\n  \\\"S\\u1ed1 n\\u00fat\\\": \\\"5\\\",\\r\\n  \\\"Th\\u1eddi l\\u01b0\\u1ee3ng pin\\\": \\\"L\\u00ean \\u0111\\u1ebfn 70 gi\\u1edd\\\",\\r\\n  \\\"C\\u00f4ng ngh\\u1ec7\\\": \\\"Lightspeed\\\",\\r\\n  \\\"K\\u00edch th\\u01b0\\u1edbc\\\": {\\r\\n    \\\"Chi\\u1ec1u d\\u00e0i\\\": \\\"125 mm\\\",\\r\\n    \\\"Chi\\u1ec1u r\\u1ed9ng\\\": \\\"63.5 mm\\\",\\r\\n    \\\"Chi\\u1ec1u cao\\\": \\\"40 mm\\\"\\r\\n  },\\r\\n  \\\"T\\u01b0\\u01a1ng th\\u00edch\\\": [\\\"Windows\\\", \\\"Mac OS\\\", \\\"Chrome OS\\\"],\\r\\n  \\\"Ph\\u1ee5 ki\\u1ec7n \\u0111i k\\u00e8m\\\": [\\\"C\\u00e1p s\\u1ea1c\\\", \\\"\\u0110\\u1ea7u thu USB\\\", \\\"Mi\\u1ebfng d\\u00e1n PTFE\\\"]\\r\\n}\"', 3899000.00, 3250000.00, 295, 'preview/image/product/681c4564-cb96-4743-a92b-9838c469fefd.webp', '\"[\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/c477e82d-6a73-4a12-9069-445ef8d93fe9.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/3b6c3345-2b37-404f-82c3-f31e16aec4b4.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/eb79bdd1-8e5c-4c9c-83c0-758d237da734.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/aa61f810-5f80-4113-8ed5-417e2d29b469.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/d65a57f7-0c7b-4d27-83fa-58072f4c43e1.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/3cd52017-63ed-4b70-a6fd-3b48152f7110.webp\\\"]\"', 'Cái', 1, 0, 1, '2025-04-10 07:13:12', '2025-04-11 11:19:15'),
(6, 'Bàn Phím MadLion Nano 68 HE RGB | Rapid Trigger', 1, 8, 'Bàn phím MadLion Nano 68 HE RGB là một sản phẩm công nghệ cao cấp được thiết kế đặc biệt dành cho game thủ và những người yêu thích công việc sáng tạo. Với kích thước nhỏ gọn, bàn phím này dễ dàng mang theo và sử dụng trong nhiều môi trường khác nhau. Công nghệ Rapid Trigger cho phép người dùng thực hiện các thao tác nhanh chóng và chính xác, tối ưu hóa trải nghiệm chơi game và làm việc.\r\n\r\nMadLion Nano 68 HE RGB nổi bật với hệ thống đèn nền RGB có thể tùy chỉnh, mang lại vẻ đẹp và sự chuyên nghiệp cho không gian làm việc của bạn. Các phím được thiết kế với độ bền cao, chịu được hàng triệu lần nhấn, đảm bảo sản phẩm sẽ đồng hành cùng bạn trong thời gian dài. Ngoài ra, bàn phím còn hỗ trợ nhiều chế độ kết nối, từ USB đến Bluetooth, giúp bạn linh hoạt lựa chọn theo nhu cầu sử dụng.\r\n\r\nVới MadLion Nano 68 HE RGB, bạn không chỉ sở hữu một công cụ làm việc hiệu quả mà còn có một sản phẩm thời trang, hiện đại, đáp ứng mọi yêu cầu khắt khe nhất của người dùng.', '\"{\\r\\n  \\\"T\\u00ean s\\u1ea3n ph\\u1ea9m\\\": \\\"B\\u00e0n Ph\\u00edm MadLion Nano 68 HE RGB\\\",\\r\\n  \\\"S\\u1ed1 ph\\u00edm\\\": 68,\\r\\n  \\\"K\\u1ebft n\\u1ed1i\\\": \\\"USB Type-C\\\",\\r\\n  \\\"Lo\\u1ea1i switch\\\": {\\r\\n    \\\"C\\u00f4ng ngh\\u1ec7\\\": \\\"Hall Effect (HE)\\\",\\r\\n    \\\"T\\u00ednh n\\u0103ng\\\": \\\"Rapid Trigger, \\u0111\\u1ed9 nh\\u1ea1y c\\u00f3 th\\u1ec3 \\u0111i\\u1ec1u ch\\u1ec9nh\\\",\\r\\n    \\\"C\\u00e1c lo\\u1ea1i switch h\\u1ed7 tr\\u1ee3\\\": [\\r\\n      \\\"MadLion HE Linear\\\",\\r\\n      \\\"MadLion HE Tactile\\\",\\r\\n      \\\"Gateron KS-20 HE\\\",\\r\\n      \\\"Wooting Lekker Switch (t\\u01b0\\u01a1ng th\\u00edch)\\\"\\r\\n    ]\\r\\n  },\\r\\n  \\\"T\\u00ednh n\\u0103ng n\\u1ed5i b\\u1eadt\\\": [\\r\\n    \\\"Rapid Trigger\\\",\\r\\n    \\\"RGB Per-Key\\\",\\r\\n    \\\"Hot-swappable\\\",\\r\\n    \\\"Ch\\u1ed1ng ghosting\\\",\\r\\n    \\\"Polling rate 1000Hz\\\"\\r\\n  ],\\r\\n  \\\"Ch\\u1ea5t li\\u1ec7u v\\u1ecf\\\": \\\"Nh\\u1ef1a ABS cao c\\u1ea5p\\\",\\r\\n  \\\"Keycap\\\": \\\"PBT Double-shot\\\",\\r\\n  \\\"H\\u1ec7 \\u0111i\\u1ec1u h\\u00e0nh t\\u01b0\\u01a1ng th\\u00edch\\\": \\\"Windows \\/ macOS \\/ Linux\\\",\\r\\n  \\\"K\\u00edch th\\u01b0\\u1edbc\\\": \\\"L375 x W125 x H40 mm\\\",\\r\\n  \\\"Tr\\u1ecdng l\\u01b0\\u1ee3ng\\\": \\\"650g\\\",\\r\\n  \\\"Ph\\u1ea7n m\\u1ec1m t\\u00f9y ch\\u1ec9nh\\\": \\\"C\\u00f3\\\"\\r\\n}\"', 1950000.00, NULL, 118, 'preview/image/product/3fdbe255-9cfe-4400-9e5c-b895e2c43760.png', '\"[\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/52ae719d-e66e-4d2d-a998-4864af206dd6.jpg\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/5dc0991b-76ca-4427-927b-fe0345c843e9.jpg\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/465bcb72-a1d2-49c5-b028-fa406311c774.jpg\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/c41f9b17-e16e-46f9-8acd-9e84e0b7bc8f.jpg\\\"]\"', 'Cái', 0, 1, 1, '2025-04-11 00:01:08', '2025-04-11 11:11:25'),
(7, 'Chuột không dây siêu nhẹ Ninjutso Sora - Đen', 2, 9, 'Chuột không dây Ninjutso Sora - Đen là một sản phẩm công nghệ hiện đại, nổi bật với thiết kế tối giản nhưng đầy tinh tế. Với màu đen sang trọng, chuột này phù hợp với mọi không gian làm việc và phong cách cá nhân. Được trang bị công nghệ không dây tiên tiến, Ninjutso Sora mang lại sự tiện lợi tối đa cho người dùng, giúp giảm bớt sự rườm rà của dây cáp truyền thống.\r\n\r\nChuột có độ nhạy cao, cho phép di chuyển mượt mà và chính xác trên nhiều bề mặt khác nhau. Thiết kế công thái học của sản phẩm giúp người dùng thoải mái khi sử dụng trong thời gian dài mà không gây mỏi tay. Ngoài ra, các nút bấm được bố trí hợp lý, dễ dàng thao tác và có độ bền cao.\r\n\r\nNinjutso Sora còn nổi bật với khả năng tiết kiệm năng lượng, giúp kéo dài thời gian sử dụng pin, phù hợp cho những ai thường xuyên di chuyển hoặc làm việc từ xa. Đây chắc chắn là một lựa chọn lý tưởng cho cả công việc và giải trí.', '\"{\\r\\n  \\\"T\\u00ean s\\u1ea3n ph\\u1ea9m\\\": \\\"Chu\\u1ed9t kh\\u00f4ng d\\u00e2y si\\u00eau nh\\u1eb9 Ninjutso Sora - \\u0110en\\\",\\r\\n  \\\"K\\u1ebft n\\u1ed1i\\\": \\\"Kh\\u00f4ng d\\u00e2y 2.4GHz \\/ USB-C (c\\u00f3 d\\u00e2y)\\\",\\r\\n  \\\"C\\u1ea3m bi\\u1ebfn\\\": \\\"PixArt PAW3395\\\",\\r\\n  \\\"\\u0110\\u1ed9 ph\\u00e2n gi\\u1ea3i (DPI)\\\": \\\"L\\u00ean t\\u1edbi 26.000 DPI\\\",\\r\\n  \\\"T\\u1ea7n s\\u1ed1 ph\\u1ea3n h\\u1ed3i (Polling rate)\\\": \\\"1000Hz\\\",\\r\\n  \\\"T\\u1ed1c \\u0111\\u1ed9 tracking\\\": \\\"650 IPS\\\",\\r\\n  \\\"Gia t\\u1ed1c\\\": \\\"50G\\\",\\r\\n  \\\"Tr\\u1ecdng l\\u01b0\\u1ee3ng\\\": \\\"47g (kh\\u00f4ng d\\u00e2y, kh\\u00f4ng l\\u1ed7)\\\",\\r\\n  \\\"Th\\u1eddi l\\u01b0\\u1ee3ng pin\\\": \\\"L\\u00ean \\u0111\\u1ebfn 70 gi\\u1edd\\\",\\r\\n  \\\"C\\u1ed5ng s\\u1ea1c\\\": \\\"USB-C\\\",\\r\\n  \\\"C\\u00f4ng t\\u1eafc switch\\\": \\\"Huano Blue Shell Pink Dot (80 tri\\u1ec7u l\\u1ea7n nh\\u1ea5n)\\\",\\r\\n  \\\"\\u0110\\u00e8n LED\\\": \\\"Kh\\u00f4ng c\\u00f3 (t\\u1ed1i \\u01b0u cho game th\\u1ee7 chuy\\u00ean nghi\\u1ec7p)\\\",\\r\\n  \\\"Thi\\u1ebft k\\u1ebf\\\": \\\"Ergonomic - Thu\\u1eadn tay ph\\u1ea3i\\\",\\r\\n  \\\"K\\u00edch th\\u01b0\\u1edbc\\\": {\\r\\n    \\\"Chi\\u1ec1u d\\u00e0i\\\": \\\"120 mm\\\",\\r\\n    \\\"Chi\\u1ec1u r\\u1ed9ng\\\": \\\"60 mm\\\",\\r\\n    \\\"Chi\\u1ec1u cao\\\": \\\"38 mm\\\"\\r\\n  },\\r\\n  \\\"T\\u01b0\\u01a1ng th\\u00edch\\\": \\\"Windows \\/ macOS \\/ Linux\\\",\\r\\n  \\\"Ph\\u1ee5 ki\\u1ec7n \\u0111i k\\u00e8m\\\": [\\r\\n    \\\"D\\u00e2y c\\u00e1p USB-C si\\u00eau m\\u1ec1m\\\",\\r\\n    \\\"\\u0110\\u1ea7u thu 2.4GHz\\\",\\r\\n    \\\"B\\u1ed9 \\u0111\\u1ed5i USB\\\"\\r\\n  ]\\r\\n}\"', 2490000.00, NULL, 91, 'preview/image/product/eef3acb2-c733-4ead-a773-fd5674a3bf16.webp', '\"[\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/16712830-8254-4500-b559-72d34832b6b2.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/272a080c-4a8f-417c-89b5-5ab512ba9e52.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/8743092a-6f04-43b7-b91c-01f7cce0f856.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/7583ef1a-5ed8-46b5-a5db-084910872938.webp\\\"]\"', 'Cái', 1, 0, 1, '2025-04-11 03:49:36', '2025-04-15 02:33:33'),
(8, 'Tấm lót chuột Steelseries QCK Heavy Large MousePad', 4, 4, 'Tấm lót chuột Steelseries QCK Heavy Large là một sản phẩm cao cấp được thiết kế dành cho các game thủ và người dùng máy tính chuyên nghiệp. Với kích thước lớn, tấm lót này mang lại không gian rộng rãi cho việc di chuyển chuột, giúp cải thiện độ chính xác và tốc độ trong các thao tác.\r\n\r\nBề mặt của QCK Heavy được làm từ vải cao cấp, mang lại độ mịn màng và cảm giác thoải mái khi sử dụng. Đặc biệt, bề mặt này còn giúp chuột di chuyển mượt mà, tối ưu hóa hiệu suất của các loại chuột quang và laser.\r\n\r\nĐế cao su chống trượt của tấm lót chuột đảm bảo độ bám chắc chắn trên mọi bề mặt, tránh tình trạng xê dịch khi sử dụng. Độ dày của QCK Heavy cũng là một điểm cộng, giúp giảm áp lực lên cổ tay và mang lại sự thoải mái tối đa trong suốt quá trình sử dụng.\r\n\r\nVới thiết kế đơn giản nhưng tinh tế, Steelseries QCK Heavy Large MousePad không chỉ là một phụ kiện hữu ích mà còn là một phần không thể thiếu trong không gian làm việc của bạn.', '\"{\\r\\n  \\\"T\\u00ean s\\u1ea3n ph\\u1ea9m\\\": \\\"SteelSeries QcK Heavy Large MousePad\\\",\\r\\n  \\\"K\\u00edch th\\u01b0\\u1edbc\\\": {\\r\\n    \\\"Chi\\u1ec1u d\\u00e0i\\\": \\\"450mm\\\",\\r\\n    \\\"Chi\\u1ec1u r\\u1ed9ng\\\": \\\"400mm\\\",\\r\\n    \\\"\\u0110\\u1ed9 d\\u00e0y\\\": \\\"6mm\\\"\\r\\n  },\\r\\n  \\\"Ch\\u1ea5t li\\u1ec7u\\\": {\\r\\n    \\\"B\\u1ec1 m\\u1eb7t\\\": \\\"V\\u1ea3i cao c\\u1ea5p Micro-Woven\\\",\\r\\n    \\\"\\u0110\\u1ebf\\\": \\\"Cao su ch\\u1ed1ng tr\\u01b0\\u1ee3t\\\"\\r\\n  },\\r\\n  \\\"M\\u00e0u s\\u1eafc\\\": \\\"\\u0110en\\\",\\r\\n  \\\"T\\u00ednh n\\u0103ng\\\": [\\r\\n    \\\"T\\u0103ng \\u0111\\u1ed9 d\\u00e0y gi\\u00fap c\\u1ea3m gi\\u00e1c tho\\u1ea3i m\\u00e1i h\\u01a1n\\\",\\r\\n    \\\"T\\u1ed1i \\u01b0u cho c\\u1ea3 c\\u1ea3m bi\\u1ebfn quang h\\u1ecdc v\\u00e0 laser\\\",\\r\\n    \\\"\\u0110\\u1ebf cao su d\\u00e0y gi\\u00fap c\\u1ed1 \\u0111\\u1ecbnh t\\u1ed1t tr\\u00ean m\\u1ecdi b\\u1ec1 m\\u1eb7t\\\"\\r\\n  ],\\r\\n  \\\"Th\\u01b0\\u01a1ng hi\\u1ec7u\\\": \\\"SteelSeries\\\",\\r\\n  \\\"T\\u01b0\\u01a1ng th\\u00edch\\\": [\\r\\n    \\\"Chu\\u1ed9t gaming\\\",\\r\\n    \\\"Chu\\u1ed9t v\\u0103n ph\\u00f2ng\\\"\\r\\n  ],\\r\\n  \\\"Xu\\u1ea5t x\\u1ee9\\\": \\\"Trung Qu\\u1ed1c\\\"\\r\\n}\"', 750000.00, 690000.00, 318, 'preview/image/product/d0c5759c-d528-439f-98bb-c86996552a37.webp', '\"[\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/2bd5c7c4-a037-4f49-b368-65878b1996f1.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/20f46fff-177b-4048-a74b-bf64d0eb6a6f.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/f01953f6-8876-4be8-a39c-b8a406d16759.webp\\\"]\"', 'Cái', 0, 0, 1, '2025-04-11 03:54:26', '2025-04-13 02:14:25'),
(9, 'Tai nghe HP HyperX Cloud III Wireless Red', 3, 5, 'Tai nghe HP HyperX Cloud III Wireless Red là một sản phẩm chất lượng cao, được thiết kế đặc biệt cho game thủ với nhiều tính năng nổi bật. Đây là tai nghe không dây, mang lại sự tiện lợi và linh hoạt trong quá trình sử dụng. Với màu đỏ mạnh mẽ, sản phẩm không chỉ thu hút về mặt thẩm mỹ mà còn thể hiện sự cá tính và phong cách.\r\n\r\nTai nghe được trang bị công nghệ âm thanh tiên tiến, cho phép người dùng trải nghiệm âm thanh sống động và chân thực. Đệm tai nghe mềm mại, tạo cảm giác thoải mái khi sử dụng trong thời gian dài. Microphone đi kèm có khả năng lọc tiếng ồn, giúp giao tiếp rõ ràng trong các trận đấu trực tuyến.\r\n\r\nNgoài ra, pin của tai nghe có thời lượng sử dụng lâu, đảm bảo không bị gián đoạn trong quá trình chơi game. Tai nghe HP HyperX Cloud III Wireless Red thực sự là lựa chọn lý tưởng cho những ai đang tìm kiếm một sản phẩm kết hợp giữa chất lượng âm thanh, thiết kế hiện đại và sự tiện dụng.', '\"{\\r\\n  \\\"product_name\\\": \\\"HP HyperX Cloud III Wireless Red\\\",\\r\\n  \\\"manufacturer\\\": \\\"HyperX\\\",\\r\\n  \\\"model\\\": \\\"Cloud III Wireless\\\",\\r\\n  \\\"color\\\": \\\"Red\\/Black\\\",\\r\\n  \\\"type\\\": \\\"Over-ear Wireless Gaming Headset\\\",\\r\\n  \\\"driver\\\": {\\r\\n    \\\"size\\\": \\\"53mm\\\",\\r\\n    \\\"type\\\": \\\"Dynamic\\\",\\r\\n    \\\"position\\\": \\\"Angled\\\"\\r\\n  },\\r\\n  \\\"frequency_response\\\": \\\"10Hz - 21kHz\\\",\\r\\n  \\\"impedance\\\": \\\"64 Ohm\\\",\\r\\n  \\\"sensitivity\\\": \\\"100 dB SPL\\\",\\r\\n  \\\"microphone\\\": {\\r\\n    \\\"type\\\": \\\"Detachable, noise-canceling\\\",\\r\\n    \\\"size\\\": \\\"10mm\\\",\\r\\n    \\\"sensitivity\\\": \\\"-21.5 dBV\\\",\\r\\n    \\\"features\\\": [\\\"LED mute indicator\\\", \\\"Mesh pop filter\\\"]\\r\\n  },\\r\\n  \\\"connectivity\\\": {\\r\\n    \\\"wireless\\\": \\\"2.4GHz\\\",\\r\\n    \\\"range\\\": \\\"Up to 20 meters\\\",\\r\\n    \\\"ports\\\": [\\\"USB-A\\\", \\\"USB-C\\\"],\\r\\n    \\\"compatibility\\\": [\\\"PC\\\", \\\"PS5\\\", \\\"PS4\\\", \\\"Nintendo Switch\\\"]\\r\\n  },\\r\\n  \\\"battery\\\": {\\r\\n    \\\"life\\\": \\\"Up to 120 hours\\\",\\r\\n    \\\"charging_port\\\": \\\"USB-C\\\"\\r\\n  },\\r\\n  \\\"features\\\": {\\r\\n    \\\"spatial_audio\\\": \\\"DTS Headphone:X\\\",\\r\\n    \\\"controls\\\": [\\\"On-ear volume control\\\", \\\"Mic mute button\\\"],\\r\\n    \\\"frame\\\": \\\"Aluminum\\\",\\r\\n    \\\"ear_cushions\\\": \\\"Memory foam with premium leatherette\\\",\\r\\n    \\\"led\\\": false\\r\\n  },\\r\\n  \\\"dimensions\\\": {\\r\\n    \\\"weight\\\": \\\"341.5g (with microphone)\\\"\\r\\n  },\\r\\n  \\\"warranty\\\": \\\"24 months\\\"\\r\\n}\"', 4390000.00, 3490000.00, 230, 'preview/image/product/62ac4c36-5088-4f8b-bba2-ad59b0dc0152.webp', '\"[\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/5d2ae05e-422c-4de8-a33b-4970ed23985d.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/f6a448e1-e73a-488d-8882-f00291aadda1.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/d87a4eb8-e7e0-448b-9b53-d52ee2ca9442.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/f485d5ee-f37e-499c-a119-2c2d944e783a.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/5b15ae5b-691d-4d26-a543-fa0fec4b68d4.webp\\\"]\"', 'Cái', 1, 0, 1, '2025-04-11 11:49:54', '2025-04-15 18:12:34'),
(10, 'Ghế Corsair T3 RUSH Charcoal 2023 (CF-9010057-WW)', 5, 3, 'Ghế Corsair T3 RUSH Charcoal 2023 là một sản phẩm cao cấp được thiết kế để mang lại sự thoải mái tối đa cho người sử dụng, đặc biệt là game thủ. Với chất liệu vải cao cấp, ghế mang lại cảm giác thoáng mát và dễ chịu ngay cả khi ngồi trong thời gian dài. Thiết kế hiện đại với màu sắc Charcoal tinh tế, tạo điểm nhấn cho không gian làm việc hay giải trí.\r\n\r\nGhế Corsair T3 RUSH được trang bị đệm mút dày và êm, hỗ trợ tốt cho lưng và cổ, giúp giảm thiểu căng thẳng và mệt mỏi. Khả năng điều chỉnh độ cao, tựa lưng và tay vịn linh hoạt giúp người dùng dễ dàng tìm được tư thế ngồi thoải mái nhất. Chân ghế bằng kim loại chắc chắn, cùng bánh xe xoay 360 độ, giúp di chuyển dễ dàng và ổn định trên mọi bề mặt.\r\n\r\nVới sự kết hợp giữa thiết kế đẹp mắt và tính năng vượt trội, Corsair T3 RUSH Charcoal 2023 là lựa chọn lý tưởng cho những ai tìm kiếm một chiếc ghế chơi game chất lượng và phong cách.', '\"{\\r\\n  \\\"product_name\\\": \\\"Corsair T3 RUSH Charcoal 2023\\\",\\r\\n  \\\"model\\\": \\\"CF-9010057-WW\\\",\\r\\n  \\\"brand\\\": \\\"Corsair\\\",\\r\\n  \\\"color\\\": \\\"Charcoal (\\u0110en\\/X\\u00e1m)\\\",\\r\\n  \\\"type\\\": \\\"Gh\\u1ebf gaming c\\u00f4ng th\\u00e1i h\\u1ecdc\\\",\\r\\n  \\\"material\\\": {\\r\\n    \\\"surface\\\": \\\"V\\u1ea3i m\\u1ec1m cao c\\u1ea5p tho\\u00e1ng kh\\u00ed\\\",\\r\\n    \\\"padding\\\": \\\"B\\u1ecdt \\u0111\\u1ec7m Polyurethane\\\",\\r\\n    \\\"frame\\\": \\\"Kim lo\\u1ea1i\\\",\\r\\n    \\\"base\\\": \\\"Nylon\\\"\\r\\n  },\\r\\n  \\\"dimensions\\\": {\\r\\n    \\\"seat_size\\\": \\\"56cm x 58cm\\\",\\r\\n    \\\"backrest_height\\\": \\\"85cm\\\",\\r\\n    \\\"backrest_width\\\": \\\"54cm\\\",\\r\\n    \\\"armrest_size\\\": \\\"26cm x 10cm x 2.65cm\\\",\\r\\n    \\\"wheel_size\\\": \\\"65mm\\\"\\r\\n  },\\r\\n  \\\"adjustability\\\": {\\r\\n    \\\"recline_angle\\\": \\\"90\\u00b0 - 160\\u00b0\\\",\\r\\n    \\\"armrest\\\": \\\"4D (L\\u00ean\\/Xu\\u1ed1ng, Tr\\u00e1i\\/Ph\\u1ea3i, Tr\\u01b0\\u1edbc\\/Sau, Xoay)\\\",\\r\\n    \\\"gas_lift_class\\\": \\\"Class 4\\\",\\r\\n    \\\"height_range\\\": \\\"100mm\\\"\\r\\n  },\\r\\n  \\\"capacity\\\": {\\r\\n    \\\"max_user_height\\\": \\\"188cm\\\",\\r\\n    \\\"max_weight\\\": \\\"120kg\\\"\\r\\n  },\\r\\n  \\\"features\\\": {\\r\\n    \\\"headrest_pillow\\\": \\\"C\\u00f3, \\u0111\\u1ec7m than ho\\u1ea1t t\\u00ednh\\\",\\r\\n    \\\"lumbar_support\\\": \\\"C\\u00f3, \\u0111\\u1ec7m than ho\\u1ea1t t\\u00ednh\\\",\\r\\n    \\\"breathable_fabric\\\": true,\\r\\n    \\\"ergonomic_design\\\": true\\r\\n  },\\r\\n  \\\"warranty\\\": \\\"24 th\\u00e1ng\\\"\\r\\n}\"', 7590000.00, 6790000.00, 200, 'preview/image/product/116d8912-c4c7-41bd-95fc-8570043c2aa1.webp', '\"[\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/63eeadcd-464a-4373-93a6-a2f5daf4f07c.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/78c6c9a4-53f2-412e-8794-debf93208bc6.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/cbd3799d-78cd-4e2c-9151-914ce7ece9b5.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/5d98a5ae-b4eb-4d5d-98c8-9ce10a335c67.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/4da4f803-2d37-4897-8142-c9cafdaccd51.webp\\\"]\"', 'Cái', 0, 0, 1, '2025-04-11 11:55:57', '2025-04-11 11:55:57'),
(11, 'Ghế Corsair TC200 Soft Fabric – Black/Black', 5, 3, 'Ghế Corsair TC200 Soft Fabric – Black/Black là một lựa chọn hoàn hảo cho những ai tìm kiếm sự thoải mái và phong cách trong không gian làm việc hoặc chơi game của mình. Với thiết kế hiện đại, ghế sử dụng chất liệu vải mềm mại, mang lại cảm giác dễ chịu ngay cả khi ngồi trong thời gian dài. Màu đen chủ đạo tạo nên vẻ ngoài sang trọng và mạnh mẽ.\r\n\r\nGhế được trang bị nhiều tính năng tiện ích như khả năng điều chỉnh độ cao, tựa lưng ngả linh hoạt, và tay vịn có thể điều chỉnh theo ý muốn, giúp người sử dụng dễ dàng tìm được tư thế ngồi lý tưởng nhất. Hệ thống bánh xe xoay 360 độ cùng khung ghế chắc chắn đảm bảo sự ổn định và linh hoạt khi di chuyển.\r\n\r\nCorsair TC200 không chỉ là một chiếc ghế thông thường mà còn là một điểm nhấn thẩm mỹ cho không gian của bạn, kết hợp hoàn hảo giữa công năng và thiết kế. Đây chắc chắn là một sự đầu tư đáng giá cho những ai coi trọng sự thoải mái và đẳng cấp.', '\"{\\r\\n  \\\"product_name\\\": \\\"Corsair TC200 Soft Fabric \\u2013 Black\\/Black\\\",\\r\\n  \\\"brand\\\": \\\"Corsair\\\",\\r\\n  \\\"model\\\": \\\"TC200\\\",\\r\\n  \\\"color\\\": \\\"\\u0110en\\/\\u0110en (Black\\/Black)\\\",\\r\\n  \\\"type\\\": \\\"Gh\\u1ebf gaming cao c\\u1ea5p\\\",\\r\\n  \\\"material\\\": {\\r\\n    \\\"surface\\\": \\\"V\\u1ea3i m\\u1ec1m cao c\\u1ea5p tho\\u00e1ng kh\\u00ed (Soft Fabric)\\\",\\r\\n    \\\"padding\\\": \\\"Foam m\\u1eadt \\u0111\\u1ed9 cao\\\",\\r\\n    \\\"frame\\\": \\\"Th\\u00e9p\\\",\\r\\n    \\\"base\\\": \\\"Kim lo\\u1ea1i s\\u01a1n t\\u0129nh \\u0111i\\u1ec7n\\\",\\r\\n    \\\"wheels\\\": \\\"B\\u00e1nh xe \\u0111\\u00f4i 75mm\\\"\\r\\n  },\\r\\n  \\\"dimensions\\\": {\\r\\n    \\\"seat_width\\\": \\\"54cm\\\",\\r\\n    \\\"seat_depth\\\": \\\"57cm\\\",\\r\\n    \\\"backrest_height\\\": \\\"82cm\\\",\\r\\n    \\\"backrest_width\\\": \\\"56cm\\\"\\r\\n  },\\r\\n  \\\"adjustability\\\": {\\r\\n    \\\"recline_angle\\\": \\\"90\\u00b0 - 180\\u00b0\\\",\\r\\n    \\\"armrest\\\": \\\"4D (L\\u00ean\\/xu\\u1ed1ng, tr\\u00e1i\\/ph\\u1ea3i, tr\\u01b0\\u1edbc\\/sau, xoay)\\\",\\r\\n    \\\"gas_lift_class\\\": \\\"Class 4\\\",\\r\\n    \\\"height_adjustment_range\\\": \\\"100mm\\\"\\r\\n  },\\r\\n  \\\"capacity\\\": {\\r\\n    \\\"max_user_height\\\": \\\"200cm\\\",\\r\\n    \\\"max_weight\\\": \\\"120kg\\\"\\r\\n  },\\r\\n  \\\"features\\\": {\\r\\n    \\\"headrest_pillow\\\": \\\"C\\u00f3, \\u0111\\u1ec7m c\\u1ed5 m\\u1ec1m\\\",\\r\\n    \\\"lumbar_support\\\": \\\"C\\u00f3, \\u0111\\u1ec7m l\\u01b0ng h\\u1ed7 tr\\u1ee3\\\",\\r\\n    \\\"breathable_fabric\\\": true,\\r\\n    \\\"ergonomic_design\\\": true,\\r\\n    \\\"high_backrest\\\": true\\r\\n  },\\r\\n  \\\"warranty\\\": \\\"24 th\\u00e1ng\\\"\\r\\n}\"', 8490000.00, 8190000.00, 129, 'preview/image/product/2c73b097-1a38-4b9c-984f-a5c4e5abd684.webp', '\"[\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/c3406690-ad66-4c91-a355-8272faf5a7e1.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/2d3864ea-0769-4cf7-8700-c5fa6d4aadd7.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/fabc59c4-c73e-43b7-a8b9-138b4c7bf1b8.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/b01391bd-6530-46a9-b72a-6b04cc272dc2.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/06cb616f-c56d-4375-b21c-8cdafbfcea71.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/d49ed527-d5f9-4f53-b98f-86cc473b0df2.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/8663c66a-a2ec-4be8-a1ea-c319212a469f.webp\\\"]\"', 'Cái', 0, 1, 1, '2025-04-11 12:01:19', '2025-04-15 18:12:34'),
(12, 'Ghế Corsair TC100 Fabric Black Grey CF-9010052-WW', 5, 3, 'Ghế Corsair TC100 Fabric Black Grey CF-9010052-WW là sự kết hợp hoàn hảo giữa thiết kế hiện đại và sự thoải mái tối ưu cho người dùng. Với chất liệu vải cao cấp, ghế mang lại cảm giác mềm mại và thoáng khí, giúp người sử dụng cảm thấy dễ chịu ngay cả khi ngồi lâu. Màu sắc đen xám sang trọng tạo nên vẻ ngoài thanh lịch, phù hợp với nhiều không gian làm việc hoặc giải trí.\r\n\r\nGhế được thiết kế với khung thép chắc chắn, đảm bảo độ bền và ổn định. Tay vịn có thể điều chỉnh linh hoạt, giúp người dùng dễ dàng tìm được vị trí thoải mái nhất. Đệm ngồi dày dặn và tựa lưng có thể ngả ra sau, hỗ trợ tối đa cho cột sống và cổ. Hệ thống nâng hạ khí nén giúp điều chỉnh độ cao ghế một cách dễ dàng.\r\n\r\nCorsair TC100 không chỉ là một chiếc ghế, mà còn là người bạn đồng hành lý tưởng cho những ai yêu thích sự tiện nghi và phong cách trong không gian của mình.', '\"{\\r\\n  \\\"product_name\\\": \\\"Corsair TC100 Fabric Black\\/Grey\\\",\\r\\n  \\\"brand\\\": \\\"Corsair\\\",\\r\\n  \\\"model\\\": \\\"TC100\\\",\\r\\n  \\\"color\\\": \\\"\\u0110en\\/X\\u00e1m (Black\\/Grey)\\\",\\r\\n  \\\"type\\\": \\\"Gh\\u1ebf ch\\u01a1i game \\/ l\\u00e0m vi\\u1ec7c\\\",\\r\\n  \\\"material\\\": {\\r\\n    \\\"surface\\\": \\\"V\\u1ea3i m\\u1ec1m tho\\u00e1ng kh\\u00ed\\\",\\r\\n    \\\"padding\\\": \\\"\\u0110\\u1ec7m foam m\\u1eadt \\u0111\\u1ed9 cao\\\",\\r\\n    \\\"frame\\\": \\\"Th\\u00e9p\\\",\\r\\n    \\\"base\\\": \\\"Ch\\u00e2n kim lo\\u1ea1i s\\u01a1n t\\u0129nh \\u0111i\\u1ec7n\\\",\\r\\n    \\\"wheels\\\": \\\"B\\u00e1nh xe \\u0111\\u00f4i 65mm\\\"\\r\\n  },\\r\\n  \\\"dimensions\\\": {\\r\\n    \\\"seat_width\\\": \\\"53.5cm\\\",\\r\\n    \\\"seat_depth\\\": \\\"55cm\\\",\\r\\n    \\\"backrest_height\\\": \\\"81.5cm\\\",\\r\\n    \\\"backrest_width\\\": \\\"56.5cm\\\"\\r\\n  },\\r\\n  \\\"adjustability\\\": {\\r\\n    \\\"recline_angle\\\": \\\"90\\u00b0 - 160\\u00b0\\\",\\r\\n    \\\"armrest\\\": \\\"2D (L\\u00ean\\/xu\\u1ed1ng, xoay)\\\",\\r\\n    \\\"gas_lift_class\\\": \\\"Class 4\\\",\\r\\n    \\\"height_adjustment_range\\\": \\\"100mm\\\"\\r\\n  },\\r\\n  \\\"capacity\\\": {\\r\\n    \\\"max_user_height\\\": \\\"195cm\\\",\\r\\n    \\\"max_weight\\\": \\\"120kg\\\"\\r\\n  },\\r\\n  \\\"features\\\": {\\r\\n    \\\"headrest_pillow\\\": \\\"C\\u00f3, r\\u1eddi\\\",\\r\\n    \\\"lumbar_support\\\": \\\"C\\u00f3, r\\u1eddi\\\",\\r\\n    \\\"ergonomic_design\\\": true,\\r\\n    \\\"breathable_fabric\\\": true,\\r\\n    \\\"high_backrest\\\": true\\r\\n  },\\r\\n  \\\"warranty\\\": \\\"24 th\\u00e1ng\\\"\\r\\n}\"', 4900000.00, NULL, 318, 'preview/image/product/6c15b504-6ce9-48ae-984f-54cdfe25a38a.webp', '\"[\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/272a90e9-40c3-4535-b63b-7a7a97d661bf.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/f58396f2-66fe-4df2-a316-a80a1b6bd9bb.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/78575586-a6c4-4d2b-970e-415da5680a28.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/f83b2bf0-5cc7-4288-a90e-3ce833fecfc3.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/7e1ab075-9fe9-4e76-86d2-f79710f707ce.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/787dbc7b-3ccb-4fdb-8997-9eacc6190c2b.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/83dfe882-26ae-4796-b75c-93da26806995.webp\\\",\\\"preview\\\\\\/image\\\\\\/product\\\\\\/gallery\\\\\\/c12a9280-b341-487f-af94-ec14a8e121ad.webp\\\"]\"', 'Cái', 0, 0, 1, '2025-04-11 12:04:26', '2025-04-13 19:17:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL COMMENT 'Điểm đánh giá (1-5 sao)',
  `comment` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Trạng thái (0=Chờ duyệt, 1=Đã duyệt, 2=Từ chối)',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 5, 'Chuột siêu nhẹ, dùng rất thích!', 1, '2025-04-10 03:52:47', '2025-04-10 03:52:47'),
(2, 10, 1, 5, 'ngon', 1, '2025-04-14 06:25:49', '2025-04-14 06:38:04'),
(3, 1, 8, 4, 'test', 2, '2025-04-14 06:38:58', '2025-04-14 06:43:58'),
(4, 10, 7, 5, 'Chuột dùng tốt, bền bỉ, giá lại êm nữa', 1, '2025-04-15 07:07:09', '2025-04-15 07:09:20'),
(5, 10, 9, 5, 'san pham xin', 1, '2025-04-15 18:15:27', '2025-04-15 18:15:51'),
(6, 1, 9, 5, 'san pham', 1, '2025-04-15 18:35:43', '2025-04-15 18:35:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3FrpbGPgCPywBD49EMMYnyal57hsdJmuXRrOICTR', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNVF5aFNFRjM4WVp3d3N1dmVWVDM5OFFIaW5OdmxYenNqSzgxNmFsciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy8zIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1744767674),
('JDeyWk0LjWIzB7hqEKoxlIITfWWW9FU5uTkYBXxx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiaGNmdXVaYnEwNW1JYWhUdWs4ejBHajZLeGlnWk9aenF4a0w4SHdTUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1744767345);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL COMMENT 'Đường dẫn khi click vào slide',
  `image` varchar(255) NOT NULL COMMENT 'Hình ảnh slide',
  `sort_order` int(11) DEFAULT 0 COMMENT 'Thứ tự hiển thị',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Trạng thái (1=Active, 0=Inactive)',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slide`
--

INSERT INTO `slide` (`id`, `title`, `description`, `link`, `image`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Khuyến mãi Logitech Gear', NULL, '/khuyen-mai/logitech', 'banner_logitech.webp', 1, 1, '2025-04-10 03:52:47', '2025-04-10 05:01:51'),
(2, 'Razer Chroma Collection', NULL, '/categories/razer', 'banner_razer.webp', 2, 1, '2025-04-10 03:52:47', '2025-04-10 05:04:48'),
(4, 'Sự kiện tháng 5', NULL, NULL, 'preview/image/slides/bf060722-0a2f-4236-b591-30c44750b547.webp', 3, 1, '2025-04-10 09:40:07', '2025-04-10 09:40:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL COMMENT 'Giới tính (ví dụ: nam, nữ, khác)',
  `level` tinyint(4) NOT NULL DEFAULT 3 COMMENT 'Phân quyền: 1=Admin, 2=Staff, 3=Customer',
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `address`, `phone`, `gender`, `level`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'Khoatran3123@gmail.com', NULL, '$2y$12$m1UKcJciDB2/YWBcL/qqv.uxdnid6XVbwTX8j/Rn8rxWz1e9ulm0e', '123 Admin Street', '0123456789', 'Nam', 1, 'ca91dbc3-2793-48f9-a831-dfadeffbf778.jpg', NULL, '2025-04-09 08:50:00', '2025-04-13 19:50:10'),
(2, 'Regular Customer', 'user@gmail.com', NULL, '$2y$12$KjE2o9s1Pipa/N9cP4XmmO6u.CdGWaC6CBJD9qBep9wZlsxxeW13K', '456 User Avenue', '0987654321', 'nữ', 3, 'avatar_default.jpg', NULL, '2025-04-09 08:50:00', '2025-04-10 15:21:36'),
(8, 'test', 'test@gmail.com', NULL, '$2y$12$3iN1YzKGhtc9qmuigjC68uKnB86901WHycL6Aa.Dc.2OLaENy5iSu', 'K226/22 Phạm Cư Lượng', '0385750387', 'Nam', 3, 'avatar_default.jpg', NULL, '2025-04-10 09:09:56', '2025-04-10 09:09:56'),
(10, 'Viết Khoa', 'michaelleon3310@gmail.com', NULL, '$2y$12$UGtPQwjyEoYK4Ob0S0ySU.BV4Y4AguLJ1V8ARkDbod/4IsE5UHiT.', 'Tổ 34 Khuê Mỹ', '0385750387', 'Nam', 3, 'b62b722f-7658-4ae3-bf45-aeb6ee179f44.jpg', 'jE73pCTTomDWVfXOVn7PxkxGo5uL4bXo5lQVUdcBAgnf46bSAknFcpBn4qPX', '2025-04-12 10:55:08', '2025-04-16 01:31:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2025-04-10 03:52:47', NULL),
(2, 2, 3, '2025-04-10 03:52:47', NULL),
(29, 8, 2, '2025-04-11 08:40:57', '2025-04-11 08:40:57'),
(30, 8, 5, '2025-04-11 08:42:39', '2025-04-11 08:42:39'),
(38, 10, 10, '2025-04-15 02:38:27', '2025-04-15 02:38:27'),
(39, 10, 9, '2025-04-15 18:11:19', '2025-04-15 18:11:19');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_replied_by_user_id_foreign` (`replied_by_user_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_author_id_foreign` (`author_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_code_unique` (`code`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_product_unique` (`user_id`,`product_id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_replied_by_user_id_foreign` FOREIGN KEY (`replied_by_user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
