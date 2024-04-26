import axios from "axios";
import CssBaseline from "@mui/material/CssBaseline";
import Grid from "@mui/material/Grid";
import Paper from "@mui/material/Paper";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import TextField from "@mui/material/TextField";
import SubmitButton from "../components/SubmitButton";
import Link from "@mui/material/Link";
import Copyright from "../components/Copyright";
import * as React from "react";
import {useState} from "react";
import {useFormik} from "formik";
import * as Yup from "yup";
import {useNavigate} from "react-router";
import {Alert} from '@mui/material';

const schema = Yup.object().shape({
    username: Yup.string()
        .min(0)
        .max(150)
        .required('Required'),
    password: Yup.string()
        .min(8)
        .max(150)
        .required('Required'),
});


export default function LoginPage() {

    const navigate = useNavigate();
    const [showWrongSigninAlert,setShowWrongSigninAlert] = useState(false);
    const formik = useFormik({
        initialValues: {
            username: '',
            password: '',
        },
        validationSchema: schema,
        onSubmit: (values, { setSubmitting }) => {
            axios.post('/api/login', {
                username: values.username,
                password: values.password,
            }).then(() => {
                navigate('/dashboard');
            }).catch((errorResponse) => {
                const { status, data } = errorResponse.response;

                if (status === 401) {
                    setShowWrongSigninAlert(true);
                    setTimeout(() => setShowWrongSigninAlert(false), 5000);
                }
            })
        },
    });

    return (
        <Grid container component="main" sx={{ height: '100vh' }}>
            <CssBaseline />
            <Grid itemxs={false} sm={4} md={7} sx={{
                backgroundImage: 'url(background.png)',
                backgroundRepeat: 'no-repeat',
                backgroundColor: (t) =>
                    t.palette.mode === 'light' ? t.palette.grey[50] : t.palette.grey[900],
                backgroundSize: 'cover',
                backgroundPosition: 'center',
            }}
            />
            <Grid item xs={12} sm={8} md={5} component={Paper} elevation={6} square>
                <Box sx={{ my: 8, mx: 4, display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
                    <Typography component="h1" variant="h5">Sign in</Typography>
                    <Box component="form" onSubmit={formik.handleSubmit} noValidate  sx={{ mt: 1,  minWidth: '480px' }}>
                        <TextField
                            margin="normal"
                            required
                            fullWidth
                            id="username"
                            label="Username"
                            maxLength={150}
                            value={formik.values.username}
                            onChange={formik.handleChange}
                            onBlur={formik.handleBlur}
                            error={
                                formik.touched.username &&
                                Boolean(formik.errors.username)
                            }
                            helperText={
                                formik.touched.username &&
                                formik.errors.username
                            }
                        />
                        <TextField
                            required
                            fullWidth
                            name="password"
                            label="Password"
                            type="password"
                            maxLength={150}
                            value={formik.values.password}
                            onChange={formik.handleChange}
                            onBlur={formik.handleBlur}
                            error={
                                formik.touched.password &&
                                Boolean(formik.errors.password)
                            }
                            helperText={
                                formik.touched.password &&
                                formik.errors.password
                            }
                        />

                        <SubmitButton>Sign in</SubmitButton>

                        { showWrongSigninAlert && (
                            <Alert sx={{ marginBottom: '10px' }}color="error">Username or password is wrong. Please try again.</Alert>
                        )}
                        <Grid container>
                            <Grid item xs>
                                <Link href="/forgot-password" variant="body2">
                                    Forgot password?
                                </Link>
                            </Grid>
                            <Grid item>
                                <Link href="/signup" variant="body2">
                                    {"Don't have an account? Sign Up"}
                                </Link>
                            </Grid>
                        </Grid>
                        <Copyright sx={{ mt: 5 }} />
                    </Box>
                </Box>
            </Grid>
        </Grid>
    );
}
