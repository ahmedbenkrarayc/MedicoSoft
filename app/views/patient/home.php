<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./assets/css/output.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.css">
</head>
<body class="font-poppins">
    <header class="relative">
        <nav class="flex items-center justify-between py-4 sm:px-6 md:px-14">
            <h1 class="font-semibold cursor-pointer">LawyerConnect</h1>
            <ul class="space-x-4 text-sm sm:hidden md:flex">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./index.php#lawyers">Find lawyer</a></li>
                <li><a href="#">About</a></li>
                <?php if(isset($_COOKIE['user_role']) && $_COOKIE['user_role'] == 'client'): ?>
                    <a href="./views/client/reservations.php">Reservations</a>
                <?php else: ?>
                    <li><a href="#">Contact</a></li>
                <?php endif; ?>
            </ul>
            <div class="sm:hidden md:flex items-center space-x-4 text-sm">
                <?php if(isset($_COOKIE['user_role']) && $_COOKIE['user_role'] == 'client'): ?>
                    <a href="./views/client/editprofile.php">Profile</a>
                    <a href="./views/auth/logout.php" class="text-white bg-black px-4 py-2">Logout</a>
                <?php else: ?>
                    <a href="./views/auth/login.php">Login</a>
                    <a href="./views/auth/signup.php" class="text-white bg-black px-4 py-2">Sign up</a>
                <?php endif; ?>
            </div>
            <img id="home-burger" class="sm:block md:hidden cursor-pointer" src="./assets/icons/menu.svg" alt="menu icon">
        </nav>

        <div id="mobilemenu" class="z-[1000] fixed w-[400px] h-screen bg-black text-white top-0 right-[-80%] px-6 py-4">
            <img id="close-burger" class="block ml-auto size-8 cursor-pointer" src="./assets/icons/x.svg" alt="x mark">
            <a href="./index.html" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6 mt-[80px]">Home</a>
            <a href="./index.html#lawyers" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">Find lawyer</a>
            <a href="#" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">About</a>
            <?php if(isset($_COOKIE['user_role']) && $_COOKIE['user_role'] == 'client'): ?>
                <a href="./views/client/reservations.php" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">Reservations</a>
                <a href="./views/client/editprofile.php" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">Profile</a>
                <a href="./views/auth/logout.php" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">Logout</a>
            <?php else: ?>
                <a href="#" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">Contact</a>
                <a href="./views/auth/login.php" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">Login</a>
                <a href="./views/auth/signup.php" class="block w-fit mx-auto px-2 pb-1 hover:border-b text-center text-xl font-[200] mb-6">Sign up</a>
            <?php endif; ?>
        </div>

        <div class="h-[600px] px-6 flex items-center justify-center bg-cover bg-blend-multiply bg-[#00000092] bg-[url('https://plus.unsplash.com/premium_photo-1673953509975-576678fa6710?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')]">
            <div class="w-fit text-center mx-auto text-white">
                <h1 class="text-4xl mt-4">Trusted health solutions for a better life.</h1>
                <p class="mt-4 text-xs">Connect with top doctors near you and book your consultation with ease—quality healthcare is just a click away!</p>
            </div>
        </div>
    </header>
    <section class="px-6 md:px-14 py-8 bg-gray-50">
    <section class="px-6 md:px-14 py-12">
    <section class="px-6 md:px-14 py-12">
    <form id="form">
    <div class="mx-auto mb-8">
        <div class="relative">
            <input id="keyword" name="name" type="text" 
                placeholder="Search ..." 
                class="w-full px-6 py-4 bg-gray-50 border-none rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-black/5 shadow-sm">
        </div>
    </div>

    <div class="max-w-6xl mx-auto mb-12">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex flex-wrap items-center gap-3">
                <select id="speciality" name="speciality" class="appearance-none px-6 py-2.5 bg-gray-50 border-none rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-black/5 cursor-pointer hover:bg-gray-100 transition-colors">
                    <option value="all">Specialization</option>
                    <option value="cardiology">Cardiology</option>
                    <option value="dermatology">Dermatology</option>
                    <option value="endocrinology">Endocrinology</option>
                    <option value="gastroenterology">Gastroenterology</option>
                    <option value="neurology">Neurology</option>
                    <option value="oncology">Oncology</option>
                    <option value="orthopedics">Orthopedics</option>
                    <option value="pediatrics">Pediatrics</option>
                    <option value="psychiatry">Psychiatry</option>
                    <option value="radiology">Radiology</option>
                    <option value="rheumatology">Rheumatology</option>
                    <option value="urology">Urology</option>
                    <option value="anesthesiology">Anesthesiology</option>
                    <option value="hematology">Hematology</option>
                    <option value="nephrology">Nephrology</option>
                    <option value="ophthalmology">Ophthalmology</option>
                    <option value="otolaryngology">Otolaryngology</option>
                    <option value="pulmonology">Pulmonology</option>
                </select>

                <select id="location" name="location" class="appearance-none px-6 py-2.5 bg-gray-50 border-none rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-black/5 cursor-pointer hover:bg-gray-100 transition-colors">
                    <option value="all">Location</option>
                    <option value="casablanca">Casablanca</option>
                    <option value="rabat">Rabat</option>
                    <option value="marrakech">Marrakech</option>
                    <option value="fes">Fes</option>
                    <option value="tangier">Tangier</option>
                    <option value="agadir">Agadir</option>
                    <option value="meknes">Meknes</option>
                    <option value="oujda">Oujda</option>
                    <option value="kenitra">Kenitra</option>
                    <option value="tetouan">Tetouan</option>
                    <option value="safi">Safi</option>
                    <option value="el-jadida">El Jadida</option>
                    <option value="nador">Nador</option>
                    <option value="khouribga">Khouribga</option>
                    <option value="beni-mellal">Beni Mellal</option>
                    <option value="taza">Taza</option>
                    <option value="mohammedia">Mohammedia</option>
                    <option value="laayoune">Laayoune</option>
                    <option value="inezgane">Inezgane</option>
                    <option value="khemisset">Khemisset</option>
                    <option value="settat">Settat</option>
                    <option value="ouarzazate">Ouarzazate</option>
                    <option value="berkane">Berkane</option>
                    <option value="al-hoceima">Al Hoceima</option>
                    <option value="taroudant">Taroudant</option>
                    <option value="errachidia">Errachidia</option>
                    <option value="guelmim">Guelmim</option>
                    <option value="ksar-el-kebir">Ksar El Kebir</option>
                    <option value="tan-tan">Tan-Tan</option>
                    <option value="asilah">Asilah</option>
                </select>
            </div>
        </div>
        
    </div>
    <button type="submit" class="w-full bg-black text-white px-6 py-2 text-sm hover:bg-black/90 transition-colors mb-2 rounded-lg">Search</button>
    <button id="reset" class="w-full bg-white border text-black px-6 py-2 text-sm transition-colors mb-12 rounded-lg">Reset</button>
    </form>    
    <!-- Lawyers Grid -->
        <div id="doctorsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
           
        </div>
    </section>
    </section>
    </section>
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
                        <img class="bg-cover h-fit" src="./assets/icons/mastercard.png" alt="mastercard icon">
                        <img class="bg-cover h-fit" src="./assets/icons/paypal.png" alt="paypal icon">
                    </div>
                </div>
            </div>
        </div>
        <hr class="mt-10 mb-4">
        <p class="text-center text-[#D7D7D7] text-xs">Copyright ©2024. All right reserved</p>
    </footer>
    <script src="./assets/js/burger.js"></script>
    <script src="./assets/js/home.js"></script>
</body>
</html>