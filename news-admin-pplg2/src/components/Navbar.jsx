import { Link, useNavigate } from "react-router-dom";
import Api from '../api';
import Cookies from 'js-cookie';
import toast from 'react-hot-toast';

export default function Navbar() {
    const navigate = useNavigate();
    const user = JSON.parse(Cookies.get('user'));

    const logout = async (e) => {
        e.preventDefault();

        try {
            await Api.post('/api/logout');
            Cookies.remove('user');
            Cookies.remove('token');
            Cookies.remove('permissions');
            toast.success('Logout Successfully!', {
                position: "top-right",
                duration: 4000,
            });
            navigate('/');
        } catch (error) {
            console.error("Logout error:", error);
            // Handle error or show an error toast
        }
    };

    return (
        <nav className="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
            <div className="container-fluid px-0">
                <div className="d-flex justify-content-between w-100" id="navbarSupportedContent">
                    <div className="d-flex align-items-center">
                    </div>
                    <ul className="navbar-nav align-items-center">
                        <li className="nav-item dropdown ms-lg-3">
                            <Link to="#" className="nav-link dropdown-toggle pt-1 px-0" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <div className="media d-flex align-items-center">
                                    <img className="avatar rounded-circle" alt="Image placeholder" src={`https://ui-avatars.com/api/?name=${user.name}&background=31316a&color=ffffff&size=100`} />
                                    <div className="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                        <span className="mb-0 font-small fw-bold text-gray-900">{user.name}</span>
                                    </div>
                                </div>
                            </Link>
                            <div className="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1 border-0 shadow">
                                <Link to="#" onClick={logout} className="dropdown-item d-flex align-items-center">
                                    <svg className="dropdown-icon text-danger me-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Logout
                                </Link>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    );
}
