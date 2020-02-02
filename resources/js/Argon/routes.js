import Index from "./views/Index.jsx";
import Profile from "./views/examples/Profile.jsx";
import RoundEntry from "../components/RoundEntry";
import CourseEntry from "../components/CourseEntry";
import ScorecardArchive from "../components/ScorecardArchive/ScorecardArchive";
import Scorecard from "../pages/Scorecard/Scorecard";
import { app } from "../constants/app";

const { baseUrl } = app;

const routes = [
  {
    path: "/dashboard",
    name: "Dashboard",
    icon: "ni ni-tv-2 text-primary",
    component: Index,
    layout: baseUrl
  },
  {
    path: "/post-round",
    name: "Post Round",
    icon: "ni ni-sound-wave text-purple",
    component: RoundEntry,
    layout: baseUrl
  },
  {
    path: "/add-course",
    name: "Add Course",
    icon: "ni ni-compass-04 text-orange",
    component: CourseEntry,
    layout: baseUrl
  },
  {
    path: "/scorecard-archive",
    name: "Scorecard Archive",
    icon: "ni ni-books text-yellow",
    component: ScorecardArchive,
    layout: baseUrl,
    param: "userId"
  },
  {
    path: "/scorecard",
    name: "Scorecard",
    icon: "ni ni-planet text-red",
    component: Scorecard,
    layout: baseUrl,
    param: "scorecardId",
    hideInSidebar: true
  },
  {
    path: "/user-profile",
    name: "Golfer Profile",
    icon: "ni ni-single-02 text-green",
    component: Profile,
    layout: baseUrl
  }
];
export default routes;
