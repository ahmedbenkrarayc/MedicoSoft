<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./../../assets/css/output.css">

</head>
<body>
<div class="flex min-h-screen bg-gray-50">
  <div class="w-64 bg-indigo-600 text-white">
    <!-- Logo Section -->
    <div class="flex items-center h-16 px-4">
      <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
      </svg>
      <span class="ml-2 text-xl font-bold">LawyerConnect</span>
    </div>

    <!-- Navigation Menu -->
    <nav class="mt-8 px-4 space-y-2">
      <a href="./dashboard.php" class="flex items-center px-4 py-2.5 bg-indigo-700 rounded-lg text-white group">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="ml-3">Dashboard</span>
      </a>

      <a href="./profile.php" class="flex items-center px-4 py-2.5 text-white hover:bg-indigo-700 rounded-lg transition-colors group">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <span class="ml-3">Profile</span>
      </a>

      <a href="./reservations.php" class="flex items-center px-4 py-2.5 text-white hover:bg-indigo-700 rounded-lg transition-colors group">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
        </svg>
        <span class="ml-3">Reservations</span>
      </a>

      <a href="./availability.php" class="flex items-center px-4 py-2.5 text-white hover:bg-indigo-700 rounded-lg transition-colors group">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
        </svg>
        <span class="ml-3">Availability</span>
      </a>

      <a href="./../auth/logout.php" class="flex items-center px-4 py-2.5 text-white hover:bg-indigo-700 rounded-lg transition-colors group">
      <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
      </svg>
        <span class="ml-3">Logout</span>
      </a>
    </nav>
  </div>

  <!-- Main Content -->
  <div class="flex-1">
    <!-- Top Navigation -->
    <div class="bg-white shadow">
      <div class="px-8 h-16 flex items-center justify-between">
        <h1 class="text-xl font-semibold text-gray-900">Dashboard</h1>
        <div class="flex items-center space-x-4">
          <button class="p-2 text-gray-400 hover:text-gray-500">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
          </button>
          <div class="flex items-center">
            <img src="<?php echo $this->params['user']['photo'] ? $this->params['user']['photo'] : 'https://static.vecteezy.com/system/resources/previews/005/544/718/non_2x/profile-icon-design-free-vector.jpg'?>" alt="Profile" class="w-8 h-8 rounded-full">
            <span class="ml-3 font-medium text-gray-700"><?php echo $this->params['user']['fname'].' '.$this->params['user']['lname'] ?></span>
          </div>
        </div>
      </div>
    </div>

    <!-- Statistics Cards -->
    <div class="p-8">
      <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
        <!-- Today's Clients Card -->
        <div class="bg-white p-6 rounded-xl shadow-sm">
          <div class="flex items-center">
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-500">Waiting Clients</p>
              <div class="flex items-baseline mt-1">
                <p class="text-2xl font-semibold text-gray-900"><?php echo $this->params['statistics'][0] ?></p>
              </div>
            </div>
            <div class="p-3 bg-green-50 rounded-lg">
              <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
            </div>
          </div>
        </div>

        <!-- Monthly Clients Card -->
        <div class="bg-white p-6 rounded-xl shadow-sm">
          <div class="flex items-center">
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-500">Approved Today</p>
              <div class="flex items-baseline mt-1">
                <p class="text-2xl font-semibold text-gray-900"><?php echo $this->params['statistics'][1] ?></p>
              </div>
            </div>
            <div class="p-3 bg-green-50 rounded-lg">
              <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
            </div>
          </div>
        </div>

        <!-- Pending Requests Card -->
        <div class="bg-white p-6 rounded-xl shadow-sm">
          <div class="flex items-center">
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-500">Approved tomorrow</p>
              <div class="flex items-baseline mt-1">
                <p class="text-2xl font-semibold text-gray-900"><?php echo $this->params['statistics'][2] ?></p>
              </div>
            </div>
            <div class="p-3 bg-red-50 rounded-lg">
              <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- Today's Clients Table -->
      <div class="bg-white rounded-xl shadow-sm">
        <div class="px-8 py-6 border-b border-gray-200">
          <h2 class="text-xl font-semibold text-gray-900">Today's Clients</h2>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php foreach($this->params['statistics'][3] as $item): ?>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $item['fname'].' '.$item['lname'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $item['email'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $item['phone'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $item['date_reservation'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Confirmed</span>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>