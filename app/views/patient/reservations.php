<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations List</title>
    <link rel="stylesheet" href="./../../assets/css/output.css">
</head>
<body class="bg-gray-50">
    <header class="relative mb-6">
        <nav class="flex items-center justify-between py-4 sm:px-6 md:px-14">
            <h1 class="font-semibold cursor-pointer">LawyerConnect</h1>
            <ul class="space-x-4 text-sm sm:hidden md:flex">
                <li><a href="./../../index.php">Home</a></li>
                <li><a href="./../../index.php#lawyers">Find lawyer</a></li>
                <li><a href="#">About</a></li>
                <?php if(isset($_COOKIE['user_role']) && $_COOKIE['user_role'] == 'client'): ?>
                    <a href="./reservations.php">Reservations</a>
                <?php else: ?>
                    <li><a href="#">Contact</a></li>
                <?php endif; ?>
            </ul>
            <div class="sm:hidden md:flex items-center space-x-4 text-sm">
                <?php if(isset($_COOKIE['user_role']) && $_COOKIE['user_role'] == 'client'): ?>
                    <a href=".//editprofile.php">Profile</a>
                    <a href="./../auth/logout.php" class="text-white bg-black px-4 py-2">Logout</a>
                <?php else: ?>
                    <a href="./../auth/login.php">Login</a>
                    <a href="./../auth/signup.php" class="text-white bg-black px-4 py-2">Sign up</a>
                <?php endif; ?>
            </div>
            <img id="home-burger" class="sm:block md:hidden cursor-pointer" src="./../../assets/icons/menu.svg" alt="menu icon">
        </nav>

        <div id="mobilemenu" class="z-[1000] fixed w-[400px] h-screen bg-black text-white top-0 right-[-80%] px-6 py-4">
            <img id="close-burger" class="block ml-auto size-8 cursor-pointer" src="./../../assets/icons/x.svg" alt="x mark">
            <a href="./../../index.html" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6 mt-[80px]">Home</a>
            <a href="./../../index.html#lawyers" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">Find lawyer</a>
            <a href="#" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">About</a>
            <?php if(isset($_COOKIE['user_role']) && $_COOKIE['user_role'] == 'client'): ?>
                <a href="./reservations.php" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">Reservations</a>
                <a href="./editprofile.php" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">Profile</a>
                <a href="./../auth/logout.php" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">Logout</a>
            <?php else: ?>
                <a href="#" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">Contact</a>
                <a href="./auth/login.php" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">Login</a>
                <a href="./auth/signup.php" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">Sign up</a>
            <?php endif; ?>
        </div>
    </header>
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Reservations</h1>
            <p class="text-sm text-gray-600">Manage your upcoming bookings</p>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Doctor Name
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Doctor phone
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Doctor email
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Reservation date
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach($this->params['reservations'] as $reservation): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="<?php echo $reservation['photo'] ?>" alt="Avatar" class="w-8 h-8 rounded-full">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><?php echo $reservation['fname'].' '.$reservation['lname'] ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?php echo $reservation['phone'] ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?php echo $reservation['email'] ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?php echo $reservation['reservation_date'] ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php 
                                    if($reservation['status'] == 'confirmed'){
                                        echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">'.$reservation['status'].'</span>';
                                    }else if($reservation['status'] == 'pending'){
                                        echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">'.$reservation['status'].'</span>';
                                    }else{
                                        echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">'.$reservation['status'].'</span>';
                                    }
                                ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="/patient/cancelreservation" method="post">
                                    <input type="hidden" name="id" value="<?php echo $reservation['id_res'] ?>">
                                    <?php 
                                        if($reservation['status'] == 'confirmed' || $reservation['status'] == 'pending'){
                                            echo '<button type="submit" name="action" value="canceled" class="text-red-600 hover:text-red-900">Cancel</button>';
                                        }
                                    ?>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer class="mt-[100px] bg-black sm:px-[4rem] md:px-[4rem] lg:px-[5rem] pt-[3rem] pb-[1rem]">
        <div class="md:flex md:gap-x-[80px] lg:gap-x-[100px] sm:w-fit mx-auto md:w-full">
            <div class="md:w-[25%]">
                <h1 class="text-white font-semibold text-xl">LawyerConnect</h1>
                <p class="text-[#D7D7D7] mt-2 text-xs">Provides expert legal services for individuals and businesses, tailored to meet client needs</p>
            </div>
            <div class="md:w-[75%] grid md:grid-cols-4 gap-y-6 sm:mt-6 md:mt-0">
                <div>
                    <h1 class="text-white font-medium text-base mb-3">Pages</h1>
                    <a class="w-fit text-[#D7D7D7] block text-[13px] mb-1" href="./views/catalog.html">Home</a>
                    <a class="w-fit text-[#D7D7D7] block text-[13px] mb-1" href="./views/catalog.html">Find lawyer</a>
                    <a class="w-fit text-[#D7D7D7] block text-[13px] mb-1" href="./views/catalog.html">Location</a>
                </div>
                <div>
                    <h1 class="text-white font-medium text-base mb-3">Pages</h1>
                    <a class="w-fit text-[#D7D7D7] block text-[13px] mb-1" href="./views/About.html">About us</a>
                    <a class="w-fit text-[#D7D7D7] block text-[13px] mb-1" href="#">Contact</a>
                    <a class="w-fit text-[#D7D7D7] block text-[13px] mb-1" href="#">Affiliates</a>
                </div>
                <div>
                    <h1 class="text-white font-medium text-base mb-3">Support</h1>
                    <a class="w-fit text-[#D7D7D7] block text-[13px] mb-1" href="#">FAQs</a>
                    <a class="w-fit text-[#D7D7D7] block text-[13px] mb-1" href="#">Cookie Policy</a>
                    <a class="w-fit text-[#D7D7D7] block text-[13px] mb-1" href="#">Terms of Use</a>
                </div>
                <div>
                    <h1 class="text-white font-medium text-base mb-2">Payment</h1>
                    <div class="flex items-center gap-x-1">
                        <img class="bg-cover h-fit" src="./../../assets/icons/mastercard.png" alt="mastercard icon">
                        <img class="bg-cover h-fit" src="./../../assets/icons/paypal.png" alt="paypal icon">
                    </div>
                </div>
            </div>
        </div>
        <hr class="mt-10 mb-4">
        <p class="text-center text-[#D7D7D7] text-xs">Copyright ©2024. All right reserved</p>
    </footer>
    <script src="./../../assets/js/burger.js"></script>
</body>
</html>