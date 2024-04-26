import {Alert, Box, Modal, Snackbar, Typography} from "@mui/material";
import Container from "@mui/material/Container";
import LoadingButton from "@mui/lab/LoadingButton";
import Button from "@mui/material/Button";
import {useState} from "react";
import axios from "axios";


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

export default function UserModalDelete({  open, handleClose, userId }) {
    const [saving, setSaving] = useState(false);
    const [snackOpen, setSnackOpen] = useState(false);

    const handleClick = () => {
        setSaving(true);
        axios.delete(`api/users/${userId}`)
            .then(function (response) {
                setSaving(false);
                setSnackOpen(true);
                setTimeout(handleClose, 5000);
            }).catch((errorResponse) => {
                setSaving(false);
            })
        };
    return ( <>
        <Modal
            open={open}
            onClose={handleClose}
        >
            <Box sx={style}>
                <Container sx={{...boxStyles, ...boxHeaderFooterStyles}}>
                    <Typography>Delete User</Typography>
                </Container>
                <Container sx={boxStyles}>
                    <Typography variant="p" component="p">
                       Do you want to delete this user?
                    </Typography>
                    <Typography><b>Attention</b>: This action is irreversible.</Typography>
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
                            onClick={handleClick}
                        >
                            <span>Yes</span>
                        </LoadingButton>

                        <Button sx={{display: 'flex', fontSize: '13px'}} variant="outlined"
                                onClick={handleClose}>No</Button>
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
                User deleted successfully.
            </Alert>
        </Snackbar>
    </>)
}
