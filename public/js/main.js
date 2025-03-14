let regions;
let regionRequest = new XMLHttpRequest();
regionRequest.open("GET", "/api/region");
regionRequest.onload = () => {
    if (regionRequest.status === 200) {
        regions = JSON.parse(regionRequest.response);
    } else {
        console.log("Server response: ", regionRequest.status);
    }
};
regionRequest.send();

let couriers;
let courierRequest = new XMLHttpRequest();
courierRequest.open("GET", "/api/courier");
courierRequest.onload = () => {
    if (courierRequest.status === 200) {
        couriers = JSON.parse(courierRequest.response);
    } else {
        console.log("Server response: ", courierRequest.status);
    }
};
courierRequest.send();

let modal = document.getElementById('modal');
modal.addEventListener('show.bs.modal', function () {
    let regionRequest = new XMLHttpRequest();
    regionRequest.open("GET", "/api/region");
    regionRequest.onload = () => {
        let regionsSelect = document.querySelector('#region');
        regions.forEach(value => {
            let opt = document.createElement('option');
            opt.value = value.id;
            opt.innerHTML = value.name;
            regionsSelect.appendChild(opt);
        });
    };
    regionRequest.send();

    let courierRequest = new XMLHttpRequest();
    courierRequest.open("GET", "/api/courier");
    courierRequest.onload = () => {
        if (courierRequest.status === 200) {
            let couriersSelect = document.querySelector('#courier');
            couriers.forEach(value => {
                let opt = document.createElement('option');
                opt.value = value.id;
                opt.innerHTML = value.lastname + ' ' + value.firstname + ' ';
                opt.innerHTML += value.middlename ?? '';
                couriersSelect.appendChild(opt);
            });
        } else {
            console.log("Server response: ", courierRequest.status);
        }
    };
    courierRequest.send();
});

document.querySelectorAll('.closeBtn').forEach(button => {
    button.addEventListener('click', function () {
        document.querySelector('#region').innerHTML = '';
        document.querySelector('#couriers').innerHTML = '';
    });
})

document.querySelector('#startDate').addEventListener('change', function (e) {
    let startDate = new Date(e.target.value);
    let endDate = new Date(startDate.toDateString());
    let regionId = document.querySelector('#region').value;
    let region = regions.find(function(value) {
        if (value.id == regionId) {
            return value;
        }
    });
    endDate = new Date(endDate.setDate(startDate.getDate() + region.days));

    document.querySelector('#endDate').value = endDate.toLocaleDateString();

    let freeCourierRequest = new XMLHttpRequest();
    let url = "/api/courier/free?" + "startDate=" + startDate.toLocaleDateString() + "&endDate=" + endDate.toLocaleDateString()
    freeCourierRequest.open("GET", url);
    freeCourierRequest.onload = () => {
        if (freeCourierRequest.status === 200) {
            let couriersSelect = document.querySelector('#courier');
            couriersSelect.innerHTML = '';
            JSON.parse(freeCourierRequest.response).forEach(value => {
                let opt = document.createElement('option');
                opt.value = value.id;
                opt.innerHTML = value.lastname + ' ' + value.firstname + ' ';
                opt.innerHTML += value.middlename ?? '';
                couriersSelect.appendChild(opt);
            });
        } else {
            console.log("Server response: ", freeCourierRequest.status);
        }
    };

    freeCourierRequest.send();
});

function addNewTrip() {
    let region = document.querySelector('#region').value;
    let courier = document.querySelector('#courier').value;
    let startDate = (new Date(document.querySelector('#startDate').value)).toLocaleDateString();
    let endDate = document.querySelector('#endDate').value;

    if (region === '' || courier === '' || startDate === '' || endDate === '') {
        alert('Не заполнены все поля!');
        document.querySelector('#region').innerHTML = '';
        document.querySelector('#courier').innerHTML = '';
        return;
    }

    let addTripRequest = new XMLHttpRequest();
    let url = "/api/courier/add?" + "startDate=" + startDate + "&endDate=" + endDate + "&courier=" + courier + "&region=" + region;
    addTripRequest.open("POST", url);
    addTripRequest.onload = () => {
        if (addTripRequest.status === 200) {
            location.reload();
        } else {
            console.log("Server response: ", addTripRequest.status);
        }
    };

    addTripRequest.send();
}
