export const setUser = (role) => {
    localStorage.setItem("role", role);
  };
  
  export const getUserRole = () => {
    return localStorage.getItem("role");
  };
  
  export const logout = () => {
    localStorage.removeItem("role");
  };
  