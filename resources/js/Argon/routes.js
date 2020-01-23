import Index from "./views/Index.jsx";
import Profile from "./views/examples/Profile.jsx";
import Register from "./views/examples/Register.jsx";
import Login from "./views/examples/Login.jsx";
import Tables from "./views/examples/Tables.jsx";
import Icons from "./views/examples/Icons.jsx";
import RoundEntry from "../components/RoundEntry";
import CourseEntry from "../components/CourseEntry";

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
