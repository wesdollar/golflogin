import Index from "./views/Index.jsx";
import Profile from "./views/examples/Profile.jsx";
import RoundEntry from "../components/RoundEntry";
import CourseEntry from "../components/CourseEntry";
import ScorecardArchive from "../components/ScorecardArchive/ScorecardArchive";
import Scorecard from "../components/Scorecard/Scorecard";

const routes = [
  {
    path: "/dashboard",
    name: "Dashboard",
    icon: "ni ni-tv-2 text-primary",
    component: Index,
    layout: "/admin"
  },
  {
    path: "/post-round",
    name: "Post Round",
    icon: "ni ni-sound-wave text-purple",
    component: RoundEntry,
    layout: "/admin"
  },
  {
    path: "/add-course",
    name: "Add Course",
    icon: "ni ni-compass-04 text-orange",
    component: CourseEntry,
    layout: "/admin"
  },
  {
    path: "/scorecard-archive",
    name: "Scorecard Archive",
    icon: "ni ni-books text-yellow",
    component: ScorecardArchive,
    layout: "/admin",
    param: "userId"
  },
  {
    path: "/scorecard",
    name: "Scorecard",
    icon: "ni ni-planet text-red",
    component: Scorecard,
    layout: "/admin",
    param: "scorecardId",
    hideInSidebar: true
  },
  {
    path: "/user-profile",
    name: "Golfer Profile",
    icon: "ni ni-single-02 text-green",
    component: Profile,
    layout: "/admin"
  }
];
export default routes;
