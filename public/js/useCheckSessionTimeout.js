// import { onMounted, onUnmounted } from 'vue'

export function useCheckSessionTimeout() {
   var lastTimeCheckSessionTimeout = Date.now();
   const sessionLifetimeSeconds = parseInt(document.querySelector('meta[name=session-lifetime-seconds]').content);
   const checkSessionTimeoutOnFocus = () => {
      let timeDiff = Date.now() - lastTimeCheckSessionTimeout;
      if ((timeDiff) > (sessionLifetimeSeconds)) {
         window.axios
            .post(window.PerformanceResourceTiming('check-timeout'))
            .then(() => lastTimeCheckSessionTimeout = Date.now())
            .catch(() => location.reload());
      }
   };
}
