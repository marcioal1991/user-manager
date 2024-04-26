import {Alert} from "@mui/material";
import TextField from '@mui/material/TextField';
import Link from '@mui/material/Link';
import Grid from '@mui/material/Grid';
import Box from '@mui/material/Box';
import Typography from '@mui/material/Typography';
import Container from '@mui/material/Container';
import Copyright from "../components/Copyright";
import {useState} from "react";
import * as Yup from "yup";
import {useFormik} from "formik";
import axios from "axios";
import SubmitButton from "../components/SubmitButton";


const schema = Yup.object().shape({
    first_name: Yup.string()
        .min(2)
        .max(150)
        .required('Required'),
    last_name: Yup.string()
        .min(2)
        .max(150)
        .required('Required'),
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
    username: Yup.string()
        .min(8)
        .max(150)
        .required('Required'),
});


export default function SignUp() {
    const [state, setState] = useState(false);
    const [saving, setSaving] = useState(false);

    const formik = useFormik({
        initialValues: {
            first_name: '',
            last_name: '',
            email: '',
            password: '',
            confirm_password: '',
            username: '',
        },
        validationSchema: schema,
        onSubmit: (values, { setSubmitting }) => {
            setSaving(true);

            const data = {
                first_name: values.first_name,
                last_name: values.last_name,
                password: values.password,
                confirm_password: values.confirm_password,
                email: values.email,
                username: values.username,
            };

            axios.post(`api/signup/`, data)
                .then(function (response) {
                    setState(true);
                    setSaving(false);
                }).catch((errorResponse) => {
                    const { status, data } = errorResponse.response;

                    if (status === 422) {
                        formik.setErrors(data.errors)
                    }
                    setSaving(false);
                });
        },
    });
    return (
            <Container maxWidth='xs'>
                <Box
                    sx={{
                        marginTop: 8,
                        display: 'flex',
                        flexDirection: 'column',
                        alignItems: 'center',
                    }}
                >
                    <Typography component="h1" variant="h5">
                        Sign up
                    </Typography>
                    {!state && (
                        <Box component="form" onSubmit={formik.handleSubmit} noValidate sx={{ mt: 3 }}>
                            <Grid container spacing={2}>
                                <Grid item xs={12} sm={6}>
                                    <TextField
                                        autoComplete="given-name"
                                        name="first_name"
                                        required
                                        fullWidth
                                        id="first_name"
                                        label="First Name"
                                        autoFocus
                                        alue={formik.values.first_name}
                                        onChange={formik.handleChange}
                                        onBlur={formik.handleBlur}
                                        disabled={saving}
                                        error={
                                            formik.touched.first_name &&
                                            Boolean(formik.errors.first_name)
                                        }
                                        helperText={
                                            formik.touched.first_name &&
                                            formik.errors.first_name
                                        }
                                    />
                                </Grid>
                                <Grid item xs={12} sm={6}>
                                    <TextField
                                        required
                                        fullWidth
                                        id="last_name"
                                        label="Last Name"
                                        name="last_name"
                                        autoComplete="family-name"
                                        alue={formik.values.last_name}
                                        onChange={formik.handleChange}
                                        onBlur={formik.handleBlur}
                                        disabled={saving}
                                        error={
                                            formik.touched.last_name &&
                                            Boolean(formik.errors.last_name)
                                        }
                                        helperText={
                                            formik.touched.last_name &&
                                            formik.errors.last_name
                                        }
                                    />
                                </Grid>
                                <Grid item xs={12}>
                                    <TextField
                                        required
                                        fullWidth
                                        id="username"
                                        label="Username"
                                        name="username"
                                        autoComplete="email"
                                        alue={formik.values.username}
                                        onChange={formik.handleChange}
                                        onBlur={formik.handleBlur}
                                        disabled={saving}
                                        error={
                                            formik.touched.username &&
                                            Boolean(formik.errors.username)
                                        }
                                        helperText={
                                            formik.touched.username &&
                                            formik.errors.username
                                        }
                                    />
                                </Grid>
                                <Grid item xs={12}>
                                    <TextField
                                        required
                                        fullWidth
                                        id="email"
                                        label="Email Address"
                                        name="email"
                                        autoComplete="email"
                                        alue={formik.values.email}
                                        onChange={formik.handleChange}
                                        onBlur={formik.handleBlur}
                                        disabled={saving}
                                        error={
                                            formik.touched.email &&
                                            Boolean(formik.errors.email)
                                        }
                                        helperText={
                                            formik.touched.email &&
                                            formik.errors.email
                                        }
                                    />
                                </Grid>
                                <Grid item xs={12}>
                                    <TextField
                                        required
                                        fullWidth
                                        name="password"
                                        label="Password"
                                        type="password"
                                        id="password"
                                        autoComplete="new-password"
                                        alue={formik.values.password}
                                        onChange={formik.handleChange}
                                        onBlur={formik.handleBlur}
                                        disabled={saving}
                                        error={
                                            formik.touched.password &&
                                            Boolean(formik.errors.password)
                                        }
                                        helperText={
                                            formik.touched.password &&
                                            formik.errors.password
                                        }
                                    />
                                </Grid>
                                <Grid item xs={12}>
                                    <TextField
                                        required
                                        fullWidth
                                        name="confirm_password"
                                        label="Confirm password"
                                        type="password"
                                        id="confirm_password"
                                        autoComplete="new-password"
                                        alue={formik.values.confirm_password}
                                        onChange={formik.handleChange}
                                        onBlur={formik.handleBlur}
                                        disabled={saving}
                                        error={
                                            formik.touched.confirm_password &&
                                            Boolean(formik.errors.confirm_password)
                                        }
                                        helperText={
                                            formik.touched.confirm_password &&
                                            formik.errors.confirm_password
                                        }
                                    />
                                </Grid>
                            </Grid>
                            <SubmitButton>
                                Sign Up
                            </SubmitButton>
                            <Grid container justifyContent="flex-end">
                                <Grid item>
                                    <Link href="/" variant="body2">
                                        Already have an account? Sign in
                                    </Link>
                                </Grid>
                            </Grid>
                        </Box>
                    )}
                </Box>

                {state && (
                    <Box>
                        <Alert severity="success">
                            Your account has been created successfully.
                            A confirmation has sent to your email, please check it.
                        </Alert>
                    </Box>
                )}
                <Copyright sx={{ mt: "20px" }} />
            </Container>
    );
}
