const doctorsContainer = document.getElementById('doctorsContainer')
const keyword = document.getElementById('keyword')
const speciality = document.getElementById('speciality')
const city = document.getElementById('location')
const form = document.getElementById('form')
const clear = document.getElementById('reset')

let data = []
let filteredData = []

const getDoctors = async () => {
    try{
        const response = await fetch('/doctor/list')
        const res = await response.json()
        if(res.success){
            data = res.data
        }
    }catch(err){
        console.error(err)
    }
}

const display = (data) => {
    doctorsContainer.innerHTML = ''
    data.forEach((item) => {
        doctorsContainer.innerHTML += `
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="relative h-48">
                    <img src="https://images.pexels.com/photos/5668869/pexels-photo-5668869.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Lawyer" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold">${item.full_name}</h3>
                    <p class="text-sm text-gray-600 mt-1">${item.specialite}/p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-sm font-medium">$${item.price}/visit</span>
                        <a href="/doctor/profile/${item.id}" class="px-4 py-2 bg-black text-white text-sm rounded-lg hover:bg-gray-800">View profile</a>
                    </div>
                </div>
            </div>
        `
    })
}

const initializePagination = () => {
    $(doctorsContainer).pagination({
        dataSource: filteredData,
        pageSize: 10,
        callback: function (data, pagination) {
            display(data);
        },
    })
}

const filter = () => {
    filteredData = [...data]

    if(speciality.value != 'all')
        filteredData = filteredData.filter((item) => item.specialite == speciality.value)
    else
        filteredData = [...data]

    if(city.value != 'all')
        filteredData = filteredData.filter((item) => item.city == city.value)
    else
        filteredData = [...data]

    if(keyword.value.trim() != '')
        filteredData = filteredData.filter((item) => item.full_name.toLowerCase().includes(keyword.value.toLowerCase()))
}

const reset = () => {
    keyword.value = ''
    speciality.value = 'all'
    city.value = 'all'
}

(async () => {
    await getDoctors()
    filteredData = [...data]
    initializePagination()

    form.addEventListener('submit', (e) => {
        e.preventDefault()
        filter()
        initializePagination()
    })

    clear.addEventListener('click', reset)
})()