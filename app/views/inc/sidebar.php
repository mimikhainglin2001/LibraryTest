<?php 
$name = $_SESSION['session_loginuser'] ?? 'Admin'; ?>
<?php
    $currentUrl = $_SERVER['REQUEST_URI']; 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Library</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Link to external CSS file (assuming admin.css handles responsive adjustments for sidebar/main content) -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/librarycss/adminDashboard.css?v=2">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/librarycss/manageMember.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/librarycss/manageBook.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/librarycss/issueBook.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/librarycss/addnewBook.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR3 authorization/lQfrg1Bw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<style>
.active{
    background-color: #1D4ED8;
    border-radius: 8px;

}

</style>
<body class="bg-gray-100">

    <!-- Main Content Area with Sidebar -->
    <div class="body-flex-container">
        <aside class="sidebar-container bg-blue-900 text-white flex flex-col shadow-lg w-70">
            <div class="p-6 text-2xl font-bold border-b border-blue-800 hidden sm:block">
                ADMIN DASHBOARD
            </div>
            <nav class="flex-1 mt-6 mr-6 w-50">
                <ul class="space-y-2">
                    <li class="<?php echo (strpos($currentUrl, '/admin/adminDashboard') !== false) || (strpos($currentUrl, '/admin/profile') !== false) ? 'active' : ''; ?>">
                        <a href="<?php echo URLROOT;?>/admin/adminDashboard" class="flex items-center p-4 text-blue-100 hover:bg-blue-700 transition duration-300 rounded-lg">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                     <li class="<?php echo (strpos($currentUrl, '/admin/adminlist') !== false) ? 'active' : ''; ?>">
                        <a href="<?php echo URLROOT;?>/admin/adminlist" class="flex items-center p-4 text-blue-100 hover:bg-blue-700 transition duration-300 rounded-lg">
                            <i class="fas fa-users mr-3"></i>
                            Manage Admin
                        </a>
                    </li>
                    <li class="<?php echo (strpos($currentUrl, '/admin/manageMember') !== false) ? 'active' : ''; ?>">
                        <a href="<?php echo URLROOT;?>/admin/manageMember" class="flex items-center p-4 text-blue-100 hover:bg-blue-700 transition duration-300 rounded-lg">
                            <i class="fas fa-users mr-3"></i>
                            Manage Students
                        </a>
                    </li>
                    <li class="<?php echo (strpos($currentUrl, '/admin/manageTeacher') !== false) ? 'active' : ''; ?>">
                        <a href="<?php echo URLROOT;?>/admin/manageTeacher" class="flex items-center p-4 text-blue-100 hover:bg-blue-700 transition duration-300 rounded-lg">
                            <i class="fas fa-users mr-3"></i>
                            Manage Teachers
                        </a>
                    </li>
                    <li  class="<?php echo (strpos($currentUrl, '/admin/manageBook') !== false) ? 'active' : ''; ?> ">
                        <a href="<?php echo URLROOT;?>/admin/manageBook" class="flex items-center p-4 text-blue-100 hover:bg-blue-700 transition duration-300 rounded-lg">
                            <i class="fas fa-book mr-3"></i>
                            Manage Books
                        </a>
                    </li>
                    <li  class="<?php echo (strpos($currentUrl, '/admin/issueBook') !== false) ? 'active' : ''; ?>">
                        <a href="<?php echo URLROOT;?>/admin/issueBook" class="flex items-center p-4 text-blue-100 hover:bg-blue-700 transition duration-300 rounded-lg">
                            <i class="fas fa-plus-circle mr-3"></i>
                            Borrow List
                        </a>
                    </li>
                    <li  class="<?php echo (strpos($currentUrl, '/admin/returnBook') !== false) ? 'active' : ''; ?>">
                        <a href="<?php echo URLROOT;?>/admin/returnBook" class="flex items-center p-4 text-blue-100 hover:bg-blue-700 transition duration-300 rounded-lg">
                            <i class="fas fa-undo-alt mr-3"></i>
                            Return
                        </a>
                    </li>
                    <li class="<?php echo (strpos($currentUrl, '/admin/reservation') !== false) ? 'active' : ''; ?>">
                        <a href="<?php echo URLROOT;?>/admin/reservation" class="flex items-center p-4 text-blue-100 hover:bg-blue-700 transition duration-300 rounded-lg">
                            <i class="fas fa-clipboard-list mr-3"></i>
                            Reservations
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT;?>/auth/logout" id="logoutButton" class="flex items-center p-4 text-blue-100 hover:bg-blue-700 transition duration-300 rounded-lg">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Logout
                </a>
                    </li>
                </ul>
            </nav>
            <!-- <div class="mt-auto p-6 border-t border-blue-800">
                
            </div> -->
        </aside>