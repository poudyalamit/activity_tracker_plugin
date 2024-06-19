console.log('tracktime.js is here guys!');

function checkLocalStorage(data) {
    console.log('Checking local storage...');
    let activity_data = localStorage.getItem('moduleActivity');
    if (activity_data) {
        print('Activity data:', activity_data);
    } else {
        startModuleActivity(data.userid, data.courseid, data.moduleid);
    }
}

function startModuleActivity(userId, courseId, moduleId, startTime) {
    console.log('Module activity tracking started!');
    // console.log($0.userId, $0.courseId, $0.moduleId);

    const activityData = {
        userid: userId,
        courseid: courseId,
        moduleid: moduleId,
        starttime: startTime,
        endtime: 0
    };
    localStorage.setItem('moduleActivity', JSON.stringify(activityData));
    console.log('Successfully set to the localstorage 22222!');
    console.log(localStorage.getItem('moduleActivity'));
}

window.addEventListener('beforeunload', function(event) {
    // const activityData = JSON.parse(localStorage.getItem('moduleActivity'));
    // if (activityData) {
    //     activityData.endtime = Date.now(); // Update end time
    //     sendActivityDataToServer(activityData);
    //     localStorage.removeItem('moduleActivity'); // Clear the stored data
    // }
    console.log('Before unload event fired!');
    let activityData = JSON.parse(localStorage.getItem('moduleActivity'));
    if (activityData) {
        console.log('Activity data:', activityData);
        sendActivityDataToServer(activityData);
        localStorage.removeItem('moduleActivity');
    }
});

function sendActivityDataToServer(activityData) {
    const url = M.cfg.wwwroot + '/blocks/activity_tracker/send_to_db.php';
    const data = new Blob([JSON.stringify(activityData)], {type : 'application/json'});
    navigator.sendBeacon(url, data);
}

// function sendActivityDataToServer(activityData) {
//     // Building the URL for the request
//     const url = M.cfg.wwwroot + '/blocks/activity_tracker/send_to_db.php';

//     // Preparing the body data in URL-encoded format
//     const formData = new URLSearchParams();
//     formData.append('userid', activityData.userid);
//     formData.append('courseid', activityData.courseid);
//     formData.append('moduleid', activityData.moduleid);
//     formData.append('starttime', activityData.starttime);
//     formData.append('endtime', activityData.endtime);

//     // Configuration for the fetch request
//     const fetchConfig = {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded',
//         },
//         credentials: 'same-origin', // ensures cookies and sessions are included
//         keepalive: true, // ensures the request keeps alive during page unloads
//         body: formData
//     };

//     // Executing the fetch request
//     fetch(url, fetchConfig)
//     .then(response => {
//         if (!response.ok) {
//             throw new Error('Network response was not ok: ' + response.statusText);
//         }
//         return response.json();
//     })
//     .then(data => {
//         console.log('Response from server:', data);
//     })
//     .catch(error => {
//         console.error('Error sending activity data:', error);
//     });
// }


function random_function() {
    console.log('Random function called!');
}

