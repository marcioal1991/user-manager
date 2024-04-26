import {createBrowserRouter,} from "react-router-dom";
import LoginPage from "../pages/LoginPage";
import SignUp from "../pages/SignUp";
import Dashboard from "../pages/Dashboard";
import EmailVerification from "../pages/EmailVerification";
import ForgotPassword from "../pages/ForgotPassword";
import ConfirmForgotPassword from "../pages/ConfirmForgotPassword";
import UsersList from "../pages/UsersList";

const router = createBrowserRouter([
    {
        path: '/',
        element: <LoginPage />,
    },
    {
        path: '/dashboard',
        element: <Dashboard />,
    },
    {
        path: '/email-verification/:id/:hash',
        element: <EmailVerification />,
    },
    {
        path: '/forgot-password',
        element: <ForgotPassword />,
    },
    {
        path: '/confirm-forgot-password/:token',
        element: <ConfirmForgotPassword />,
    },
    {
        path: '/signup',
        element: <SignUp />,
    },
    {
        path: '/users',
        element: <UsersList />,
    }
], {
    basename: '/'
});

export default router;

export const guestRoutes = Object.freeze([
    '/',
    '/signup',
    '/email-verification',
    '/forgot-password',
    '/confirm-forgot-password',
]);

export const authRoutes = Object.freeze([
    'users',
    'dashboard',
]);
