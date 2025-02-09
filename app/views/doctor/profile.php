<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->params['doctor']['fname'].' '.$this->params['doctor']['lname'] ?></title>
    <link rel="stylesheet" href="./../../assets/css/output.css">
    <style>
        #calendar {
        display: flex;
        flex-direction: column;
        width: 320px;
        margin: 20px auto;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px;
        }
        #calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        }
        #calendar-header button {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 5px 10px;
        cursor: pointer;
        }
        #calendar-header button:hover {
        background-color: #0056b3;
        }
        #calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
        margin-top: 10px;
        }
        .day {
        text-align: center;
        padding: 10px;
        cursor: pointer;
        border: 1px solid #ddd;
        border-radius: 4px;
        }
        .day:hover {
        background-color: #f0f0f0;
        }
        .selected {
        background-color: #007bff;
        color: white;
        }
  </style>
</head>
<body>
<section class="w-full overflow-hidden">
    <header class="relative">
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
    <div class="flex flex-col">
        <img src="https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Doctor Cover"
                class="w-full xl:h-[20rem] lg:h-[18rem] md:h-[16rem] sm:h-[14rem] xs:h-[11rem] object-cover" />

        <div class="sm:w-[80%] xs:w-[90%] mx-auto flex">
            <img src="<?php echo $this->params['doctor']['photo'] ? $this->params['doctor']['photo'] : 'https://static.vecteezy.com/system/resources/previews/005/544/718/non_2x/profile-icon-design-free-vector.jpg'?>" alt="Doctor Profile"
                    class="rounded-md lg:w-[12rem] lg:h-[12rem] md:w-[10rem] md:h-[10rem] sm:w-[8rem] sm:h-[8rem] xs:w-[7rem] xs:h-[7rem] outline outline-2 outline-offset-2 outline-blue-500 relative lg:bottom-[5rem] sm:bottom-[4rem] xs:bottom-[3rem]" />

            <h1
                class="w-full text-left my-4 sm:mx-4 xs:pl-4 text-gray-800 lg:text-4xl md:text-3xl sm:text-3xl xs:text-xl font-serif">
                <?php echo $this->params['doctor']['fname'].' '.$this->params['doctor']['lname'] ?></h1>

        </div>

        <div
            class="xl:w-[80%] lg:w-[90%] md:w-[90%] sm:w-[92%] xs:w-[90%] mx-auto flex flex-col gap-4 items-center relative lg:-top-8 md:-top-6 sm:-top-4 xs:-top-4">
            <!-- Description -->
            <p class="w-fit text-gray-700 text-md"><?php echo $this->params['doctor']['biographie'] ?></p>


            <!-- Detail -->
            <div class="w-full my-auto py-6 flex flex-col justify-center gap-2">
                <div class="w-full flex sm:flex-row xs:flex-col gap-2 justify-center">
                    <div class="w-full">
                        <dl class="text-gray-900 divide-y divide-gray-200">
                            <div class="flex flex-col pb-3">
                                <dt class="mb-1 text-gray-500 md:text-lg">First Name</dt>
                                <dd class="text-lg font-semibold"><?php echo $this->params['doctor']['fname'] ?></dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 md:text-lg">Last Name</dt>
                                <dd class="text-lg font-semibold"><?php echo $this->params['doctor']['lname'] ?></dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 md:text-lg">Speciality</dt>
                                <dd class="text-lg font-semibold"><?php echo $this->params['doctor']['specialite'] ?></dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 md:text-lg">Experience</dt>
                                <dd class="text-lg font-semibold"><?php echo $this->params['doctor']['experience'] ?></dd>
                            </div>
                        </dl>
                    </div>
                    <div class="w-full">
                        <dl class="text-gray-900 divide-y divide-gray-200">
                            <div class="flex flex-col pb-3">
                                <dt class="mb-1 text-gray-500 md:text-lg">Address</dt>
                                <dd class="text-lg font-semibold"><?php echo $this->params['doctor']['address'].', '.$this->params['doctor']['city'].', '.$this->params['doctor']['country'] ?></dd>
                            </div>

                            <div class="flex flex-col pt-3">
                                <dt class="mb-1 text-gray-500 md:text-lg">Phone Number</dt>
                                <dd class="text-lg font-semibold"><?php echo $this->params['doctor']['phone'] ?></dd>
                            </div>
                            <div class="flex flex-col pt-3">
                                <dt class="mb-1 text-gray-500 md:text-lg">Email</dt>
                                <dd class="text-lg font-semibold"><?php echo $this->params['doctor']['email'] ?></dd>
                            </div>
                            <div class="flex flex-col pt-3">
                                <dt class="mb-1 text-gray-500 md:text-lg">Visit rate</dt>
                                <dd class="text-lg font-semibold hover:text-blue-500"><?php echo $this->params['doctor']['price'].'$' ?></dd>
                            </div>
                        </dl>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
    <div id="calendar">
    <div id="calendar-header">
      <button id="prev-month">←</button>
      <h3 id="month-year"></h3>
      <button id="next-month">→</button>
    </div>
    <div id="calendar-days"></div>
  </div>
  <form id="date-form" action="/patient/createreservation/<?= $this->params['doctor']['id'] ?>" method="POST" style="display: none;">
    <input type="hidden" name="selected_date" id="selected_date">
    <input type="submit" value="Submit Date">
  </form>

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
  <script>
    const calendarDays = document.getElementById('calendar-days');
    const monthYear = document.getElementById('month-year');
    const prevMonth = document.getElementById('prev-month');
    const nextMonth = document.getElementById('next-month');
    const dateForm = document.getElementById('date-form');
    const selectedDateInput = document.getElementById('selected_date');

    let currentDate = new Date();

    // Get the disabled date range from PHP
    const dateStart = '<?php echo $this->params['availability'] ? $this->params['availability']['start'] : '' ?>';
    const dateEnd = '<?php echo $this->params['availability'] ? $this->params['availability']['end'] : ''; ?>';

    // Function to check if a date is within the range
    function isDateDisabled(date) {
      if (dateStart && dateEnd) {
        const startDate = new Date(dateStart);
        const endDate = new Date(dateEnd);
        return date >= startDate && date <= endDate;
      }
      return false; // If no range is set, no date is disabled
    }

    function renderCalendar(date) {
      const year = date.getFullYear();
      const month = date.getMonth();
      const firstDay = new Date(year, month, 1).getDay();
      const daysInMonth = new Date(year, month + 1, 0).getDate();

      calendarDays.innerHTML = '';
      monthYear.textContent = `${date.toLocaleString('default', { month: 'long' })} ${year}`;

      for (let i = 0; i < firstDay; i++) {
        const emptyDay = document.createElement('div');
        calendarDays.appendChild(emptyDay);
      }

      for (let day = 1; day <= daysInMonth; day++) {
        const dayElement = document.createElement('div');
        const currentDay = new Date(year, month, day);
        dayElement.textContent = day;
        dayElement.classList.add('day');

        // Check if the date is disabled
        if (isDateDisabled(currentDay)) {
          dayElement.classList.add('disabled');
          dayElement.style.cursor = 'not-allowed';  // Disable clicking
        } else {
          dayElement.addEventListener('click', () => {
            document.querySelectorAll('.day').forEach(d => d.classList.remove('selected'));
            dayElement.classList.add('selected');
            
            selectedDateInput.value = `${year}-${month + 1}-${day < 10 ? '0' + day : day}`;
            
            dateForm.submit();
          });
        }

        calendarDays.appendChild(dayElement);
      }
    }

    prevMonth.addEventListener('click', () => {
      currentDate.setMonth(currentDate.getMonth() - 1);
      renderCalendar(currentDate);
    });

    nextMonth.addEventListener('click', () => {
      currentDate.setMonth(currentDate.getMonth() + 1);
      renderCalendar(currentDate);
    });

    renderCalendar(currentDate);
  </script>
</section>
</body>
</html>