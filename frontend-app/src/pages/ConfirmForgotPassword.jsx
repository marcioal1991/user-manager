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
import {Alert, CircularProgress} from '@mui/material';
import {useParams} from "react-router";

const schema = Yup.object().shape({
    email: Yup.string()
        .email('Invalid email')
        .required('Required'),
    password: Yup.string()
        .min(8)
        .max(150)
        .required('Required'),
    confirm_password: Yup.string()
        .min(8)
        .max(150)
        .oneOf([Yup.ref('password'), null], 'Passwords must match')
        .required('Required'),
});


export default function ConfirmForgotPassword() {
    const { token } = useParams();
    const [showRecoveryInfo, setShowRecoveryInfo] = useState(false);
    const [sending, setSending] = useState(false);

    const formik = useFormik({
        initialValues: {
            email: '',
            password: '',
            confirm_password: '',
            token: token,
        },
        validationSchema: schema,
        onSubmit: (values) => {
            setSending(true);
            console.log(values);
            axios.post('/api/confirm-forgot-password', {
                email: values.email,
                password: values.password,
                confirm_password: values.confirm_password,
                token: values.token,
            }).then(() => {
                setShowRecoveryInfo(true);
            }).catch((errorResponse) => {

            })
        },
    });

    return (
        <Grid container component="main" sx={{ height: '100vh' }}>
            <CssBaseline />
            <Grid item sm={4} md={7} sx={{
                backgroundImage: 'url(/background.png)',
                backgroundRepeat: 'no-repeat',
                backgroundColor: (t) =>
                    t.palette.mode === 'light' ? t.palette.grey[50] : t.palette.grey[900],
                backgroundSize: 'cover',
                backgroundPosition: 'center',
            }}
            />
            <Grid item xs={12} sm={8} md={5} component={Paper} elevation={6} square>
                <Box sx={{ my: 8, mx: 4, display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
                    <Typography component="h1" variant="h5">Reset password</Typography>
                    <Box component="form" onSubmit={formik.handleSubmit} noValidate  sx={{ mt: 1, minWidth: '480px' }}>
                        <Box sx={{ display: 'flex', flexDirection: 'column'}}>
                            <TextField
                                margin="normal"
                                required
                                fullWidth
                                id="email"
                                label="Email"
                                maxLength={150}
                                value={formik.values.email}
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                disabled={sending}
                                error={
                                    formik.touched.email &&
                                    Boolean(formik.errors.email)
                                }
                                helperText={
                                    formik.touched.email &&
                                    formik.errors.email
                                }

                            />

                            <TextField
                                required
                                fullWidth
                                margin="normal"
                                name="password"
                                label="Password"
                                type="password"
                                id="password"
                                autoComplete="new-password"
                                value={formik.values.password}
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                disabled={sending}
                                error={
                                    formik.touched.password &&
                                    Boolean(formik.errors.password)
                                }
                                helperText={
                                    formik.touched.password &&
                                    formik.errors.password
                                }
                            />

                            <TextField
                                required
                                fullWidth
                                margin="normal"
                                name="confirm_password"
                                label="Confirm password"
                                type="password"
                                id="confirm_password"
                                value={formik.values.confirm_password}
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                disabled={sending}
                                error={
                                    formik.touched.confirm_password &&
                                    Boolean(formik.errors.confirm_password)
                                }
                                helperText={
                                    formik.touched.confirm_password &&
                                    formik.errors.confirm_password
                                }
                            />

                            <SubmitButton disabled={showRecoveryInfo || sending}>
                                {sending ? (<CircularProgress disableShrink size={"1.55rem"} />) : ("Submit")}
                            </SubmitButton>

                            { showRecoveryInfo && (
                                <Alert sx={{ marginBottom: '10px' }} color="info">
                                    your password was successfully changed.
                                </Alert>
                            )}
                            <Grid container>
                                <Grid item xs>
                                    <Link href="/" variant="body2">
                                        Go to Sign In
                                    </Link>
                                </Grid>
                            </Grid>
                            <Copyright sx={{ mt: 5 }} />
                        </Box>
                    </Box>
                </Box>
            </Grid>
        </Grid>
    );
}
