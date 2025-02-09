<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp | MedicoSoft <?= $test ?></title>
    <link rel="stylesheet" href="<?= 'http://'.$_SERVER['HTTP_HOST'].'/assets/css/output.css' ?>">
</head>
<body>
    <header class="relative">
        <nav class="flex items-center justify-between py-4 sm:px-6 md:px-14">
            <h1 class="font-semibold cursor-pointer"><?= $_ENV['APP_NAME'] ?></h1>
            <ul class="space-x-4 text-sm sm:hidden md:flex">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./index.php#lawyers">Find lawyer</a></li>
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
            <img id="home-burger" class="sm:block md:hidden cursor-pointer" src="./assets/icons/menu.svg" alt="menu icon">
        </nav>

        <div id="mobilemenu" class="z-[1000] fixed w-[400px] h-screen bg-black text-white top-0 right-[-80%] px-6 py-4">
            <img id="close-burger" class="block ml-auto size-8 cursor-pointer" src="./assets/icons/x.svg" alt="x mark">
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
    <div class="bg-gray-50">
        <div class="flex min-h-[80vh] flex-col justify-center py-12 sm:px-6 lg:px-8">
            <div class="text-center sm:mx-auto sm:w-full sm:max-w-md">
                <h1 class="text-3xl font-extrabold text-gray-900">
                    Sign up
                </h1>
            </div>
            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white px-4 pb-4 pt-8 sm:rounded-lg sm:px-10 sm:pb-6 sm:shadow">
                    <ul class="text-red-500 list-disc px-4 mb-4">
                        <?php 
                            if(isset($this->params['errors'])):
                                foreach($this->params['errors'] as $error): 
                        ?>
                        <li><?= $error ?></li>
                        <?php 
                                endforeach;
                            endif; 
                        ?>
                    </ul>

                    <?php
                        if(isset($this->params['success']) && $this->params['success'] == true){
                            header('location: /auth/login');
                        }
                    ?>
                    <form id="register" method="POST" action="/auth/register" class="space-y-6">
                        <div>
                            <label for="fname" class="block text-sm font-medium text-gray-700">First Name</label>
                            <div class="mt-1">
                                <input id="fname" type="text"
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    name="fname" value="">
                                <span class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div>
                            <label for="lname" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <div class="mt-1">
                                <input id="lname" type="text"
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    name="lname" required value="">
                                <span class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <div class="mt-1">
                                <input id="phone" type="text" data-testid="username"
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    name="phone" required value="">
                                <span class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                            <div class="mt-1">
                                <input id="email" type="email" data-testid="username"
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    name="email" required value="">
                                <span class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-1">
                                <input id="password" required name="password" type="password" data-testid="password"
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    >
                                <span class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <div class="mt-1">
                                <select id="role" name="role"
                                    required
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    >
                                    <option value="patient">Patient</option>
                                    <option value="doctor">Doctor</option>
                                </select>
                                <span class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div>
                            <button data-testid="login" type="submit"
                                class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-wait disabled:opacity-50">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                Sign Up
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="mt-[100px] bg-black sm:px-[4rem] md:px-[4rem] lg:px-[5rem] pt-[3rem] pb-[1rem]">
        <div class="md:flex md:gap-x-[80px] lg:gap-x-[100px] sm:w-fit mx-auto md:w-full">
            <div class="md:w-[25%]">
                <h1 class="text-white font-semibold text-xl"><?= $_ENV['APP_NAME'] ?></h1>
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
        <p class="text-center text-[#D7D7D7] text-xs">Copyright ©2025. All right reserved</p>
    </footer>
    <script src="<?= 'http://'.$_SERVER['HTTP_HOST'].'/assets/js/burger.js' ?>"></script>
    <script src="<?= 'http://'.$_SERVER['HTTP_HOST'].'/assets/js/register.js' ?>"></script>
</body>
</html>