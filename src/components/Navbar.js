import { Link } from "react-router-dom";
import { getUserRole } from "../utils/auth";

const Navbar = () => {
  const role = getUserRole();

  return (
    <nav>
      <Link to="/">Home</Link>
      {role === "admin" && <Link to="/admin">Admin</Link>}
      {role === "user" && <Link to="/user">User</Link>}
    </nav>
  );
};

export default Navbar;
