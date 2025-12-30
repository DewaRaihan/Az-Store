<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail HP - {{ $title ?? 'HP Inventory' }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js (jika Livewire menggunakan Alpine) -->
    @livewireStyles
    
    <style>
        .status-available { background-color: #d1fae5; color: #065f46; }
        .status-sold { background-color: #fee2e2; color: #991b1b; }
        .status-reserved { background-color: #fef3c7; color: #92400e; }
    </style>
</head>
<body class="bg-gray-50">
    {{ $slot }}
    
    @livewireScripts
</body>
</html>