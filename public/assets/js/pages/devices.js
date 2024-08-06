
let devices = document.getElementsByClassName('device');
Array.from(devices).forEach((device) => {
    let deviceKeys = device.getElementsByClassName('device-key');
    let deviceKeysTitle = device.getElementsByClassName('device-key-title');
    let imei = device.getElementsByClassName('device-imei')[0].innerText;
    let rssi = device.getElementsByClassName('device-rssi')[0];
    if(!rssi){
        return;
    }
    let relayModuleTerminals = device.getElementsByClassName('relay-module-terminals')[0];
    Array.from(deviceKeys).forEach((deviceKey, idx) => {
        let deviceKeyTitle = deviceKeysTitle[idx];
        deviceKey.addEventListener('change', function(event){
            let fieldName = this.dataset.field;
            let value;
            if(this.type == "checkbox"){
                value = this.checked ? 1 : 0;
            }else{
                value = this.value;
            }
            if(fieldName == "relay_module"){
                relayModuleTerminals.style.display = value ? "block" : "none";
            }
            deviceKeyTitle.classList.add('wait-update');
            this.disabled = true;
            $.post("/updateDevice", {
                imei: imei,
                field: fieldName,
                value: value,
            });
        });
    });
    let hidableLock1 = device.getElementsByClassName('hidable-lock1');
    let hidableLock2 = device.getElementsByClassName('hidable-lock2');
    let hidableLocks = device.getElementsByClassName('hidable-locks');
    let removeLock1 = device.getElementsByClassName('remove-lock1')[0];
    let removeLock2 = device.getElementsByClassName('remove-lock2')[0];
    if(removeLock1 && removeLock2){
        removeLock1.addEventListener('click', () => {
            if(hidableLock2[0].classList.contains("d-none")){
                hidableLocks[0].classList.add("d-none");
            }else{
                hidableLock1[0].classList.add("d-none");
                hidableLock1[1].classList.add("d-none");
            }
            $.post("/updateDevice", {
                imei: imei,
                field: 'lock_status1',
                value: null,
            });
        });
        removeLock2.addEventListener('click', () => {
            if(hidableLock1[0].classList.contains("d-none")){
                hidableLocks[0].classList.add("d-none");
            }else{
                hidableLock2[0].classList.add("d-none");
                hidableLock2[1].classList.add("d-none");
            }
            $.post("/updateDevice", {
                imei: imei,
                field: 'lock_status2',
                value: null,
            });
        });
    }
});

let ssidInputs = document.querySelectorAll('.device-key[data-field="ssid"]');
Array.from(ssidInputs).forEach((ssidInput) => {
    ssidInput.addEventListener('input', function(event){
        let input = event.target;
        input.value = input.value.replace(/[^A-Za-z0-9]/g, '');
    });
});

setInterval(() => {
    Array.from(devices).forEach((device) => {
        let deviceKeys = device.getElementsByClassName('device-key');
        let deviceKeysTitle = device.getElementsByClassName('device-key-title');
        let imei = device.getElementsByClassName('device-imei')[0].innerText;
        let rssi = device.getElementsByClassName('device-rssi')[0];
        if(!rssi){
            return;
        }
        Array.from(deviceKeysTitle).forEach((deviceKeyTitle, idx) => {
            if(!deviceKeyTitle.classList.contains('wait-update')){
                return;
            }
            let deviceKey = deviceKeys[idx];
            let doneCallback = (data) => {
                if(data == 0){
                    deviceKey.disabled = false;
                    deviceKeyTitle.classList.remove('wait-update');
                }
            };
            if(deviceKey.dataset.field == "door_status"){
                $.post("/doorStatusUpdated/" + imei).done(doneCallback);
            }else if(deviceKey.dataset.field == "alarm_status"){
                $.post("/alarmStatusUpdated/" + imei).done(doneCallback);
            }else{
                deviceKey.disabled = false;
                deviceKeyTitle.classList.remove('wait-update');
                return;
            }
        });
    });
}, 3000);

setInterval(() => {
    $.get("/deviceUpdate").done((response) => {
        Array.from(response).forEach((device, idx) => {
            Object.entries(device).forEach(([field, value]) => {
                if(field == "ups_status"){
                    let element = document.querySelector(`#device-panel-${device.id} .device-key-ups`);
                    if(element){
                        element.innerText = value ? "برق شهری" : "برق باطری";
                    }
                }else if(field == "lock_status1"){
                    let element = document.querySelector(`#device-panel-${device.id} .device-key-lock1`);
                    let enableImg = document.querySelector(`.img-lock1-enable`);
                    let disableImg = document.querySelector(`.img-lock1-disable`);
                    if(element){
                        element.innerText = "قفل 1: " + (value ? "بسته" : "باز");
                        if(value){
                            enableImg.classList.remove("d-none");
                            disableImg.classList.add("d-none");
                        }else{
                            enableImg.classList.add("d-none");
                            disableImg.classList.remove("d-none");
                        }
                    }
                }else if(field == "lock_status2"){
                    let element = document.querySelector(`#device-panel-${device.id} .device-key-lock2`);
                    let enableImg = document.querySelector(`.img-lock2-enable`);
                    let disableImg = document.querySelector(`.img-lock2-disable`);
                    if(element){
                        element.innerText = "قفل 2: " + (value ? "بسته" : "باز");
                        if(value){
                            enableImg.classList.remove("d-none");
                            disableImg.classList.add("d-none");
                        }else{
                            enableImg.classList.add("d-none");
                            disableImg.classList.remove("d-none");
                        }
                    }
                }else if(field == "temperature"){
                    let element = document.querySelector(`#device-panel-${device.id} .device-key-temperature`);
                    if(element){
                        element.innerText = "" + value + "°C";
                    }
                }else if(field == "bat_status"){
                    let element = document.querySelector(`#device-panel-${device.id} .device-key-bat`);
                    if(element){
                        element.innerText = "" + value + "%";
                    }
                }else if(field == "status"){
                    let element = document.querySelector(`#device-panel-${device.id} .device-key-status`);
                    if(element){
                        element.innerText = value ? "فعال" : "غیرفعال";
                        if(value){
                            element.classList.remove("danger");
                            element.classList.add("success");
                        }else{
                            element.classList.remove("success");
                            element.classList.add("danger");
                        }
                    }
                    element = document.getElementById(`device_status_${device.id}`)
                    if(element){
                        element.innerText = value ? "فعال" : "غیرفعال";
                        if(value){
                            element.classList.remove("danger");
                            element.classList.add("success");
                        }else{
                            element.classList.remove("success");
                            element.classList.add("danger");
                        }
                    }
                }else if(field == "rssi"){
                    let element = document.querySelector(`#device-panel-${device.id} .device-rssi`);
                    if(element){
                        element.innerText = `RSSI: ${value}`;
                    }
                }else{
                    let element = document.querySelector(`#device-panel-${device.id} .device-key[data-field="${field}"]:not(.wait-update)`);
                    if(element){
                        if(element.type == "checkbox"){
                            element.checked = value;
                        }else if(!document.activeElement.isEqualNode(element)){
                            element.value = value;
                        }
                    }
                }
            });
        });
    });
}, 6000);
