console.log("Focus tracking script loaded!");

let lastActivityTime = Date.now();
const idleThreshold = 300000 / 5; // 5 minutes, adjust as necessary
let idleTimer;

function resetIdleTimer() {
  lastActivityTime = Date.now();
  if (idleTimer) clearTimeout(idleTimer);
  idleTimer = setTimeout(() => {
    console.log("User has been idle for 5 minute!");
    return lastActivityTime;
  }, idleThreshold);
}

function startIdealActivity(userId, courseId, moduleId) {
  console.log('Ideal activity tracking started!');
  const idealData = {
    userid: userId,
    courseid: courseId,
    moduleid: moduleId,
    ideal: true
  };
  localStorage.setItem('idealActivity', JSON.stringify(idealData));
  sendIdealDataToServer(idealData);
  console.log('Successfully set to the localstorage!');
  console.log(localStorage.getItem('idealActivity'));
}

function checkLocalStorage(data) {
  if (Date.now() - lastActivityTime > idleThreshold) {
    console.log("User has been idle for 5 minute!");
    let ideal_data = localStorage.getItem('idealActivity');
    if (ideal_data) {
      console.log('Ideal data:', ideal_data);
    } else {
      startIdealActivity(data.userid, data.courseid, data.moduleid);
    }
  }else{
    console.log(`User is active till ${Date.now() - lastActivityTime}!`);
  }
}

function sendIdealDataToServer(idealData) {
  const url = M.cfg.wwwroot + '/blocks/activity_tracker/send_ideal_to_db.php';
  const data = new Blob([JSON.stringify(idealData)], {type : 'application/json'});
  navigator.sendBeacon(url, data);
}

document.addEventListener("mousemove", resetIdleTimer);
document.addEventListener("keydown", resetIdleTimer);
document.addEventListener("click", resetIdleTimer);
document.addEventListener("scroll", resetIdleTimer);

function handleVisibilityChange() {
  if (document.hidden) {
    console.log("Tab is inactive");
    // React to the tab becoming inactive
  } else {
    console.log("Tab is active");
    // React to the tab becoming active
  }
}

document.addEventListener("visibilitychange", handleVisibilityChange);

window.addEventListener("blur", function () {
  console.log("Window lost focus");
});
window.addEventListener("focus", function () {
  console.log("Window gained focus");
});
