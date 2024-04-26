import {Alert, Box, Modal, Snackbar, Typography} from "@mui/material";
import Container from "@mui/material/Container";
import LoadingButton from '@mui/lab/LoadingButton';
import Button from "@mui/material/Button";
import {useState} from "react";
import Grid from "@mui/material/Grid";
import TextFieldWithCharCount from "../Utils/TextFieldWithCharCount";
import DatePicker from "../Utils/DatePicker";
import axios from "axios";
import {useFormik} from "formik";
import * as Yup from "yup";

const style = {
    position: 'absolute',
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)',
    width: 400,
    backgroundColor: '#ffffff',
    overflow: 'hidden',
    borderRadius: '10px',
    minWidth: '1000px',
};

const boxStyles = {
    paddingTop: '24px',
    paddingBottom: '24px',
};

const boxHeaderFooterStyles = {
    backgroundColor: '#f9f9f9',
}

const createHandleEvent = function (setState) {
    return function (event) {
        setState(event.target.value);
    }
};

export const defaultValues = {
    username: '',
    email: '',
    first_name: '',
    last_name: '',
    mobile: '',
    date_of_birth: '',
};

const schema = Yup.object().shape({
    first_name: Yup.string()
        .min(2, 'Too Short!')
        .max(150, 'Too Long!')
        .required('Required'),
    last_name: Yup.string()
        .min(2, 'Too Short!')
        .max(150, 'Too Long!')
        .required('Required'),
    email: Yup.string()
        .email('Invalid email')
        .required('Required'),
    mobile: Yup.string()
        .min(8)
        .max(150)
        .required('Required'),
    username: Yup.string()
        .min(8)
        .max(150)
        .required('Required'),
});



export default function UserModalUpsert({ values = null, open, handleClose, text, alertText }) {
    const [saving, setSaving] = useState(false);
    const [snackOpen, setSnackOpen] = useState(false);

    const formik = useFormik({
        initialValues: values ?? defaultValues,
        validationSchema: schema,
        onSubmit: (values, { setSubmitting }) => {
            setSaving(true);

            axios.post('api/users/', {
                first_name: values.first_name,
                last_name: values.last_name,
                mobile: values.mobile,
                email: values.email,
                username: values.username,
                date_of_birth: values.date_of_birth
            }).then(function (response) {
                setSaving(false);
                setSnackOpen(true);
                handleClose();
            }).catch((errorResponse) => {
                const { status, data } = errorResponse.response;

                if (status === 422) {
                    formik.setErrors(data.errors)
                }

                setSaving(false);
            })

        },
    });

    return (
        <>
            <Modal
                open={open}
                onClose={handleClose}
            >
                <Box sx={style}>
                    <Container sx={{...boxStyles, ...boxHeaderFooterStyles}}>
                        <Typography>Create new user</Typography>
                    </Container>
                    <Container sx={boxStyles}>
                        <Typography variant="p" component="p">
                            {text || "Fill in the following fields to create a new user. The user will receive an email with a link for email verification."}
                        </Typography>
                        <Box component="form" onSubmit={formik.handleSubmit} noValidate sx={{mt: 3}}>
                            <Grid container spacing={2}>
                                <Grid item sm={6}>
                                    <TextFieldWithCharCount
                                        name="first_name"
                                        required
                                        fullWidth
                                        label="First Name"
                                        maxLength={150}
                                        value={formik.values.first_name}
                                        onChange={formik.handleChange}
                                        onBlur={formik.handleBlur}
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
                                <Grid item sm={6}>
                                    <TextFieldWithCharCount
                                        name="last_name"
                                        required
                                        fullWidth
                                        label="Last Name"
                                        maxLength={150}
                                        value={formik.values.last_name}
                                        onChange={formik.handleChange}
                                        onBlur={formik.handleBlur}
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
                                <Grid item sm={6}>
                                    <TextFieldWithCharCount
                                        name="email"
                                        required
                                        fullWidth
                                        label="Email"
                                        maxLength={150}
                                        value={formik.values.email}
                                        onChange={formik.handleChange}
                                        onBlur={formik.handleBlur}
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
                                <Grid item sm={6}>
                                    <TextFieldWithCharCount
                                        name="mobile"
                                        required
                                        fullWidth
                                        label="Mobile"
                                        maxLength={150}
                                        value={formik.values.mobile}
                                        onChange={formik.handleChange}
                                        onBlur={formik.handleBlur}
                                        error={
                                            formik.touched.mobile &&
                                            Boolean(formik.errors.mobile)
                                        }
                                        helperText={
                                            formik.touched.mobile &&
                                            formik.errors.mobile
                                        }
                                    />
                                </Grid>
                                <Grid item sm={6}>
                                    <DatePicker
                                        name="date_of_birth"
                                        required
                                        sx={{width: '100%'}}
                                        label="Date of birth"
                                        value={formik.values.date_of_birth}
                                        onChange={formik.handleChange}
                                        onBlur={formik.handleBlur}
                                        error={
                                            formik.touched.date_of_birth &&
                                            Boolean(formik.errors.date_of_birth)
                                        }
                                        helperText={
                                            formik.touched.date_of_birth &&
                                            formik.errors.date_of_birth
                                        }
                                    />
                                </Grid>
                                <Grid item sm={6}>
                                    <TextFieldWithCharCount
                                        name="username"
                                        required
                                        fullWidth
                                        maxLength={150}
                                        label="Username"
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
                                </Grid>
                            </Grid>
                        </Box>
                    </Container>
                    <Container sx={{...boxStyles, ...boxHeaderFooterStyles}}>
                        <Box sx={{display: "flex", flexDirection: "row-reverse", justifyItems: 'flex-end'}}>
                            <LoadingButton
                                sx={{marginLeft: "10px"}}
                                size="small"
                                loading={saving}
                                variant="contained"
                                disabled={saving}
                                disableElevation
                                onClick={formik.handleSubmit}
                            >
                                <span>Save</span>
                            </LoadingButton>

                            <Button sx={{display: 'flex', fontSize: '13px'}} variant="outlined"
                                    onClick={handleClose}>Cancel</Button>
                        </Box>
                    </Container>

                </Box>
            </Modal>
            <Snackbar
                open={snackOpen}
                onClose={function () {
                    setSnackOpen(false)
                }}
                autoHideDuration={6000}>
                <Alert
                    severity="success"
                    variant="filled"
                    sx={{ width: '100%' }}
                >
                    { alertText }
                </Alert>
            </Snackbar>
        </>
    )
}
