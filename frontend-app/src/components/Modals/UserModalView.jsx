import {Box, Modal, Skeleton, Typography} from "@mui/material";
import Container from "@mui/material/Container";
import Button from "@mui/material/Button";
import {useEffect, useRef, useState} from "react";
import axios from "axios";
import Grid from "@mui/material/Grid";


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

export default function UserModalView({  open, handleClose, userId }) {
    const [loading, setLoading] = useState(true);

    const ref = useRef({});
    useEffect(() => {
        axios.get(`/api/users/${userId}`).then((axiosResponse) => {
            const { data } = axiosResponse.data;
            ref.date_of_birth = data.date_of_birth || '';
            ref.email = data.email || '';
            ref.first_name = data.first_name || '';
            ref.last_name = data.last_name || '';
            ref.mobile = data.mobile_number || '';
            ref.username = data.username || '';
            setLoading(false);
        }).catch(() => {

        });
    }, []);

    return ( <>
        <Modal
            open={open}
            onClose={handleClose}
        >
            <Box sx={style}>
                <Container sx={{...boxStyles, ...boxHeaderFooterStyles}}>
                    <Typography>View profile</Typography>
                </Container>
                <Container sx={boxStyles}>
                    { loading ?
                        (
                            <>
                                <Skeleton variant="rectangular" width="100%" height={50} sx={{ marginBottom: '10px' }} />
                                <Skeleton variant="rectangular" width="100%" height={20} sx={{ marginBottom: '10px' }} />
                                <Skeleton variant="rectangular" width="100%" height={20} sx={{ marginBottom: '10px' }} />
                            </>
                        ) : (
                            <Box>
                                <Grid container >
                                    <Grid item xs={6} sx={{ marginBottom: '10px'}}>
                                        <Typography variant="p" component="p"><b>First name:</b> {ref.first_name}</Typography>
                                    </Grid>
                                    <Grid item xs={6} sx={{ marginBottom: '10px'}}>
                                        <Typography variant="p" component="p"><b>Mobile:</b> {ref.mobile}</Typography>
                                    </Grid>
                                    <Grid item xs={6} sx={{ marginBottom: '10px'}}>
                                        <Typography variant="p" component="p"><b>Last name:</b> {ref.last_name}</Typography>
                                    </Grid>
                                    <Grid item xs={6} sx={{ marginBottom: '10px'}}>
                                        <Typography variant="p" component="p"><b>Date of birth:</b> {ref.date_of_birth || '-'}</Typography>
                                    </Grid>
                                    <Grid item xs={6} sx={{ marginBottom: '10px'}}>
                                        <Typography variant="p" component="p"><b>Username:</b> {ref.username}</Typography>
                                    </Grid>
                                    <Grid item xs={6} sx={{ marginBottom: '10px'}}>
                                        <Typography variant="p" component="p"><b>Email:</b> {ref.email}</Typography>
                                    </Grid>
                                </Grid>
                            </Box>
                        )
                    }
                </Container>
                <Container sx={{...boxStyles, ...boxHeaderFooterStyles}}>
                    <Box sx={{display: "flex", flexDirection: "row-reverse", justifyItems: 'flex-end'}}>
                        <Button sx={{display: 'flex', fontSize: '13px'}} variant="outlined"
                                onClick={handleClose}>Close</Button>
                    </Box>
                </Container>
            </Box>
        </Modal>
    </>)
}
