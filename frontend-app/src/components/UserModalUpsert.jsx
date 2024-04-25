import {Box, Modal, Typography} from "@mui/material";
import Container from "@mui/material/Container";
import LoadingButton from '@mui/lab/LoadingButton';
import Button from "@mui/material/Button";
import {useState} from "react";

const style = {
    position: 'absolute',
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)',
    width: 400,
    backgroundColor: '#ffffff',
    overflow: 'hidden',
    borderRadius: '10px'

};

const boxStyles = {
    paddingTop: '24px',
    paddingBottom: '24px',
};

const boxHeaderFooterStyles = {
    backgroundColor: '#f9f9f9',
}

export default function UserModalUpsert({ open, handleClose }) {
    const [saving, setSaving] = useState(false);
    const handleSave = () => {
        setSaving(true);
        setTimeout(function () {
            setSaving(false)
        }, 5000)
    }
    return (
        <Modal
            open={open}
            onClose={handleClose}
        >
            <Box sx={style}>
                <Container sx={{ ...boxStyles, ...boxHeaderFooterStyles }}>
                    <Typography>Create new user</Typography>
                </Container>
                <Container sx={ boxStyles }>
                    <Typography id="modal-modal-title" variant="h6" component="h2">
                        Text in a modal
                    </Typography>
                    <Typography id="modal-modal-description" sx={{ mt: 2 }}>
                        Duis mollsis, est non commodo luctus, nisi erat porttitor ligula.
                    </Typography>
                </Container>
                <Container sx={{ ...boxStyles, ...boxHeaderFooterStyles }}>
                    <Box sx={{ display: "flex", flexDirection: "row-reverse", justifyItems: 'flex-end' }}>
                        <LoadingButton
                            sx={{ marginLeft: "10px" }}
                            size="small"
                            onClick={handleSave}
                            loading={saving}
                            variant="contained"
                            disabled={saving}
                            disableElevation
                        >
                            <span>Save</span>
                        </LoadingButton>

                        <Button sx={{ display: 'flex', fontSize: '13px' }} variant="outlined" onClick={handleClose}>Cancel</Button>
                    </Box>
                </Container>
            </Box>
        </Modal>
    )
}
