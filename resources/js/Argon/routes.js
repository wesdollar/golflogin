import Index from "./views/Index.jsx";
import Profile from "./views/examples/Profile.jsx";
import Register from "./views/examples/Register.jsx";
import Login from "./views/examples/Login.jsx";
import RoundEntry from "../components/RoundEntry";
import CourseEntry from "../components/CourseEntry";
import ScorecardArchive from "../components/ScorecardArchive/ScorecardArchive";
import Scorecard from "../components/Scorecard/Scorecard";

const routes = [
  {
    path: "/index",
    name: "Dashboard",
    icon: "ni ni-tv-2 text-primary",
    component: Index,
    layout: "/admin"
  },
  {
    path: "/post-round",
    name: "Post Round",
    icon: "ni ni-planet text-blue",
    component: RoundEntry,
    layout: "/admin"
  },
  {
    path: "/add-course",
    name: "Add Course",
    icon: "ni ni-planet text-blue",
    component: CourseEntry,
    layout: "/admin"
  },
  {
    path: "/scorecard-archive",
    name: "Scorecard Archive",
    icon: "ni ni-planet text-blue",
    component: ScorecardArchive,
    layout: "/admin",
    param: "userId"
  },
  {
    path: "/scorecard",
    name: "Scorecard",
    icon: "ni ni-planet text-blue",
    component: Scorecard,
    layout: "/admin",
    param: "scorecardId",
    hideInSidebar: true
  },
  {
    path: "/user-profile",
    name: "Golfer Profile",
    icon: "ni ni-single-02 text-yellow",
    component: Profile,
    layout: "/admin"
  },
  {
    path: "/login",
    name: "Login",
    icon: "ni ni-key-25 text-info",
    component: Login,
    layout: "/auth"
  },
  {
    path: "/register",
    name: "Register",
    icon: "ni ni-circle-08 text-pink",
    component: Register,
    layout: "/auth"
  }
];
export default routes;
