import React, {useEffect, useState} from "react";
import {RouterProvider} from "react-router-dom";
import router, {guestRoutes} from "./routes/router";
import axios from 'axios';
import SplashScreen from "./components/SplashScreen";
import {createTheme, ThemeProvider} from "@mui/material/styles";
import CssBaseline from "@mui/material/CssBaseline";
import "./App.css";
import Box from "@mui/material/Box";

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;
axios.defaults.baseURL = 'http://localhost/';

function App() {
    const [loadingApp, setLoadingApp] = useState(true);
    const defaultTheme = createTheme({
        components: {
            MuiContainer: {
                styleOverrides: {
                    maxWidth: '1800px',
                },
            },
        },
    });

    useEffect(() => {
        axios.all([
            axios.get('/sanctum/csrf-cookie'),
            axios.get('/api/check')
        ]).then(() => {
            if (guestRoutes.includes(window.location.pathname)) {
                window.location.replace('http://localhost:3000/dashboard');
                return;
            }

            setLoadingApp(false);
        }).catch((AxiosError) => {
            if (AxiosError.response.status === 401 && !guestRoutes.includes(window.location.pathname)) {
                window.location.replace('http://localhost:3000/');
                return;
            }

            setLoadingApp(false);
        });
    }, []);

    if (loadingApp) {
        return (
            <SplashScreen />
        )
    }

    return (
        <ThemeProvider theme={defaultTheme}>
            <Box sx={{ display: 'flex' }}>
                <CssBaseline />
                <RouterProvider router={router} />
            </Box>
        </ThemeProvider>
    );
}

export default App;
