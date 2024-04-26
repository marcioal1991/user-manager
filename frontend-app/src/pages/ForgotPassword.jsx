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

const schema = Yup.object().shape({
    username: Yup.string()
        .min(0)
        .max(150)
        .required('Required'),
});


export default function ForgotPassword() {
    const [showRecoveryInfo, setShowRecoveryInfo] = useState(false);
    const [sending, setSending] = useState(false);

    const formik = useFormik({
        initialValues: {
            username: '',
        },
        validationSchema: schema,
        onSubmit: (values) => {
            setSending(true);
            axios.post('/api/forgot-password', {
                username: values.username,
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
                    <Typography component="h1" variant="h5">Forgot password</Typography>
                    <Box component="form" onSubmit={formik.handleSubmit} noValidate  sx={{ mt: 1, minWidth: '480px' }}>
                        <Box sx={{ display: 'flex', flexDirection: 'column'}}>
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
                                disabled={showRecoveryInfo}
                                error={
                                    formik.touched.username &&
                                    Boolean(formik.errors.username)
                                }
                                helperText={
                                    formik.touched.username &&
                                    formik.errors.username
                                }
                            />

                            <SubmitButton disabled={showRecoveryInfo || sending}>
                                {sending ? (<CircularProgress disableShrink size={"1.55rem"} />) : ("Submit")}
                            </SubmitButton>

                            { showRecoveryInfo && (
                                <Alert sx={{ marginBottom: '10px' }} color="info">
                                    We received your request for recovery password. If we find and account with this email, you will receive an email with more instructions.
                                </Alert>
                            )}
                            <Grid container>
                                <Grid item xs>
                                    <Link href="/login" variant="body2">
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
