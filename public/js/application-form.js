document.addEventListener('DOMContentLoaded', function() {
    const submitBtn = document.querySelector('button[type="submit"]');
    
    // Event listener for submit button
    submitBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            const formData = constructPayload();
            console.log('Form payload:', formData);
            sendFormData(formData);
        }
    });
    
    // Check final checklist
    function validateForm() {
        let isValid = true;
        const checklistItems = [
            'checkCompleteForm',
            'checkMaterials',
            'checkReferences',
            'checkPayment'
        ];
        
        checklistItems.forEach(id => {
            const item = document.getElementById(id);
            if (item && !item.checked) {
                isValid = false;
                item.classList.add('is-invalid');
            }
        });
        
        if (!isValid) {
            alert('Please check the final checklist before submitting.');
            return false;
        }
        
        return true;
    }
    
    function constructPayload() {
        const payload = {
            sectionA: getSectionAData(),
            sectionB: getSectionBData(),
            sectionC: getSectionCData(),
            sectionD: getSectionDData(),
            sectionE: getSectionEData(),
            sectionF: getSectionFData(),
            sectionG: getSectionGData(),
            sectionH: getSectionHData(),
            sectionI: getSectionIData(),
            sectionJ: getSectionJData(),
            sectionK: getSectionKData(),
            sectionL: getSectionLData(),
            sectionM: getSectionMData(),
            sectionN: getSectionNData(),
            sectionO: getSectionOData(),
            sectionP: getSectionPData(),
            sectionQ: getSectionQData()
        };
        return payload;
        // return cleanPayload(payload);
    }
    
    // remove null or empty values
    function cleanPayload(obj) {
        const cleaned = {};
        for (const key in obj) {
            if (obj[key] !== null && obj[key] !== undefined && obj[key] !== '') {
                if (typeof obj[key] === 'object' && !Array.isArray(obj[key])) {
                    const nestedCleaned = cleanPayload(obj[key]);
                    if (Object.keys(nestedCleaned).length > 0) {
                        cleaned[key] = nestedCleaned;
                    }
                } else if (Array.isArray(obj[key])) {
                    if (obj[key].length > 0) {
                        cleaned[key] = obj[key];
                    }
                } else {
                    cleaned[key] = obj[key];
                }
            }
        }
        return cleaned;
    }
    
    // Section-specific data collection functions
    function getSectionAData() {
        return {
            courseCode: document.getElementById('courseCode')?.value,
            courseTitle: document.getElementById('courseSearch')?.value,
            researchField: document.getElementById('researchField')?.value,
            supervisor: document.getElementById('supervisor')?.value,
            unavailableDates: {
                start: document.getElementById('unavailableDatesStart')?.value,
                end: document.getElementById('unavailableDatesEnd')?.value
            },
            researchIntent: document.querySelector('input[name="researchIntent"]:checked')?.value
        };
    }
    
    function getSectionBData() {
        const hasPreference = document.getElementById('hasPreference')?.checked;
        return {
            hasPreference: hasPreference,
            collegePreference: hasPreference ? document.getElementById('collegePreference')?.value : 'No preference'
        };
    }
    
    function getSectionCData() {
        return {
            givenName: document.getElementById('givenName')?.value,
            preferredName: document.getElementById('preferredName')?.value,
            middleName: document.getElementById('middleName')?.value,
            familyName: document.getElementById('familyName')?.value,
            previousFamilyName: document.getElementById('previousFamilyName')?.value,
            title: document.getElementById('title')?.value,
            sex: document.querySelector('input[name="sex"]:checked')?.value,
            dob: document.getElementById('dob')?.value,
            previousGivenName: document.getElementById('previousGivenName')?.value,
            nameChangeDates: {
                familyFrom: document.getElementById('previousFamilyFrom')?.value,
                familyTo: document.getElementById('previousFamilyTo')?.value,
                givenFrom: document.getElementById('previousGivenFrom')?.value,
                givenTo: document.getElementById('previousGivenTo')?.value
            }
        };
    }
    
    function getSectionDData() {
        return {
            homeAddress: {
                address: document.getElementById('homeAddress')?.value,
                city: document.getElementById('homeCity')?.value,
                postcode: document.getElementById('homePostcode')?.value,
                state: document.getElementById('homeState')?.value,
                country: document.getElementById('homeCountry')?.value
            },
            correspondenceAddress: {
                address: document.getElementById('correspondenceAddress')?.value,
                city: document.getElementById('correspondenceCity')?.value,
                postcode: document.getElementById('correspondencePostcode')?.value,
                state: document.getElementById('correspondenceState')?.value,
                country: document.getElementById('correspondenceCountry')?.value
            },
            effectiveDates: {
                from: document.getElementById('effectiveFrom')?.value,
                to: document.getElementById('effectiveTo')?.value
            },
            phoneNumber: {
                countryCode: document.getElementById('countryCode')?.value,
                areaCode: document.getElementById('areaCode')?.value,
                number: document.getElementById('phoneNumber')?.value
            },
            altPhoneNumber: {
                countryCode: document.querySelectorAll('#countryCode')[1]?.value,
                areaCode: document.querySelectorAll('#areaCode')[1]?.value,
                number: document.querySelectorAll('#phoneNumber')[1]?.value
            },
            email: document.getElementById('email')?.value,
            altEmail: document.getElementById('altEmail')?.value
        };
    }
    
    function getSectionEData() {
        const hasNominee = document.getElementById('yesNominate')?.checked;
        return {
            hasThirdParty: hasNominee,
            nomineeDetails: hasNominee ? {
                name: document.getElementById('nomineeName')?.value,
                email: document.getElementById('nomineeEmail')?.value,
                dob: document.getElementById('nomineeBirth')?.value
            } : null
        };
    }
    
    function getSectionFData() {
        const dualNationality = document.getElementById('dualYes')?.checked;
        
        const nationality1 = {
            nationality: document.getElementById('nationality1')?.value,
            startDate: document.getElementById('nationalityDate1')?.value,
            passportNumber: document.getElementById('passportNumber1')?.value,
            issueCountry: document.getElementById('issueCountry1')?.value,
            expiryDate: document.getElementById('passportExpiry1')?.value
        };
        const nationality2 = dualNationality ? {
            nationality: document.getElementById('nationality2')?.value,
            startDate: document.getElementById('nationalityDate2')?.value,
            passportNumber: document.getElementById('passportNumber2')?.value,
            issueCountry: document.getElementById('issueCountry2')?.value,
            expiryDate: document.getElementById('passportExpiry2')?.value
        } : null;
        
        const requiresVisa = document.querySelector('input[name="requireVisa"]:checked')?.value;
        const visaDetails = requiresVisa === 'yes' ? {
            currentResidence: document.getElementById('currentResidence')?.value,
            residenceDates: {
                from: document.getElementById('fromDate')?.value,
                to: document.getElementById('toDate')?.value
            },
            euNationalInUK: document.querySelector('input[name="euNationalEducation"]:checked')?.value,
            previousResidence: document.getElementById('previousResidence')?.value,
            previousResidenceDates: {
                from: document.getElementById('prevFromDate')?.value,
                to: document.getElementById('prevToDate')?.value
            },
            indefiniteLeave: document.querySelector('input[name="indefiniteLeave"]:checked')?.value,
            indefiniteLeaveGrantedDate: document.getElementById('grantedDate')?.value
        } : null;
        
        return {
            birthCountry: document.getElementById('birthCountry')?.value,
            nationality1,
            nationality2,
            requiresVisa: requiresVisa,
            visaDetails: visaDetails
        };
    }
    
    function getSectionGData() {
        const requiresAccommodation = document.getElementById('accommodationYes')?.checked;
        const children = [];
        
        if (requiresAccommodation) {
            document.querySelectorAll('.child-entry').forEach(child => {
                children.push({
                    sex: child.querySelector('[name="child_sex"]')?.value,
                    dob: child.querySelector('[name="child_dob"]')?.value
                });
            });
        }
        
        return {
            requiresAccommodation: requiresAccommodation,
            accompanyingDetails: requiresAccommodation ? {
                children: children.length > 0 ? children : null,
                adults: document.getElementById('accompanying_adults')?.value
            } : null
        };
    }
    
    function getSectionHData() {
        const referees = [];
        
        document.querySelectorAll('.mb-4.border').forEach(referee => {
            referees.push({
                name: referee.querySelector('[name^="referee"]')?.value,
                address: referee.querySelector('[name^="referee"][name$="address"]')?.value,
                type: referee.querySelector('[name^="referee"][name$="type"]')?.value,
                submission: referee.querySelector('[name^="referee"][name$="submission"]:checked')?.value
            });
        });
        
        return {
            referees: referees
        };
    }
    
    function getSectionIData() {
        const educationHistory = [];
        const ukEducationHistory = [];
        
        document.querySelectorAll('.education-entry').forEach(entry => {
            educationHistory.push({
                institution: entry.querySelector('[name^="institution"]')?.value,
                startDate: entry.querySelector('[name^="start_date"]')?.value,
                completionDate: entry.querySelector('[name^="completion_date"]')?.value,
                qualification: entry.querySelector('[name^="qualification"]')?.value,
                subject: entry.querySelector('[name^="subject"]')?.value,
                result: entry.querySelector('[name^="result"]')?.value
            });
        });
        
        document.querySelectorAll('.uk-education-entry').forEach(entry => {
            ukEducationHistory.push({
                institution: entry.querySelector('[name^="uk_institution"]')?.value,
                startDate: entry.querySelector('[name^="uk_start_date"]')?.value,
                completionDate: entry.querySelector('[name^="uk_completion_date"]')?.value,
                courseTitle: entry.querySelector('[name^="course_title"]')?.value,
                level: entry.querySelector('[name^="level"]')?.value
            });
        });
        
        const incompleteStudy = document.querySelector('input[name="incomplete_study"]:checked')?.value;
        const concurrentStudy = document.querySelector('input[name="concurrent_study"]:checked')?.value;
        
        return {
            educationHistory: educationHistory,
            ukEducationHistory: ukEducationHistory.length > 0 ? ukEducationHistory : null,
            incompleteStudy: incompleteStudy,
            incompleteStudyDetails: incompleteStudy === 'yes' ? 
                document.querySelector('[name="incomplete_study_details"]')?.value : null,
            concurrentStudy: concurrentStudy,
            concurrentStudyDetails: concurrentStudy === 'yes' ? 
                document.querySelector('[name="concurrent_study_details"]')?.value : null
        };
    }
    
    function getSectionJData() {
        return {
            greTest: {
                date: document.getElementById('GRE_date')?.value,
                verbalScore: document.getElementById('verbal_score')?.value,
                verbalPercent: document.getElementById('verbal_percent')?.value,
                quantitativeScore: document.getElementById('quantiative_score')?.value,
                quantitativePercent: document.getElementById('quantiative_percent')?.value,
                writingScore: document.getElementById('writing_score')?.value,
                writingPercent: document.getElementById('writing_percentage')?.value
            }
        };
    }
    
    function getSectionKData() {
        return {
            englishFirstLanguage: document.querySelector('input[name="english_first"]:checked')?.value,
            englishQualification: document.querySelector('input[name="qualification"]:checked')?.value,
            tier4Visa: document.querySelector('input[name="tier4_visa"]:checked')?.value
        };
    }
    
    function getSectionLData() {
        const languages = [];
        
        document.querySelectorAll('.language-entry').forEach(entry => {
            languages.push({
                language: entry.querySelector('[name^="language_name"]')?.value,
                reading: entry.querySelector('[name^="reading_level"]')?.value,
                writing: entry.querySelector('[name^="writing_level"]')?.value,
                speaking: entry.querySelector('[name^="speaking_level"]')?.value,
                understanding: entry.querySelector('[name^="understanding_level"]')?.value
            });
        });

        const testWaiverRequest = document.querySelector('input[name="testWaiverIntent"]:checked')?.value === 'yes';
        
        return {
            englishTest: {
                testType: document.querySelector('[name="test_type"]')?.value,
                dateTaken: document.querySelector('[name="date_taken"]')?.value,
                overallResult: document.querySelector('[name="overall_result"]')?.value,
                listening: document.querySelector('[name="listening_score"]')?.value,
                reading: document.querySelector('[name="reading_score"]')?.value,
                writing: document.querySelector('[name="writing_score"]')?.value,
                speaking: document.querySelector('[name="speaking_score"]')?.value
            },
            testWaiverRequest: testWaiverRequest,
            otherLanguages: languages.length > 0 ? languages : []
        };
    }
    
    function getSectionMData() {
        const fundingSources = [];
        
        document.querySelectorAll('#fundingTableBody tr').forEach(row => {
            fundingSources.push({
                source: row.querySelector('[name^="source"]')?.value,
                amount: row.querySelector('[name^="amount"]')?.value,
                period: row.querySelector('[name^="period"]')?.value,
                status: row.querySelector('[name^="status"]:checked')?.value
            });
        });
        
        const applyingForStudentship = document.querySelector('input[name="studentshipApply"]:checked')?.value;
        
        return {
            alternativeFunding: document.querySelector('input[name="alternativeFunding"]:checked')?.value === 'yes',
            fundingSources: fundingSources.length > 0 ? fundingSources : null,
            applyingForStudentship: applyingForStudentship,
            studentshipReferenceCode: applyingForStudentship === 'yes' ? 
                document.getElementById('referenceCode')?.value : null,
            oxfordScholarships: {
                hillFoundation: document.getElementById('hillFoundation')?.checked,
                ertetgun: document.getElementById('ertetgun')?.checked,
                ocis: document.getElementById('ocis')?.checked,
                weidenfeld: document.getElementById('weidenfeld')?.checked,
                ahrc: document.getElementById('ahrc')?.checked,
                grandUnion: document.getElementById('grandUnion')?.checked
            }
        };
    }
    
    function getSectionNData() {
        return {
            numScholarships: document.getElementById('numScholarships')?.value || 0
        };
    }
    
    function getSectionOData() {
        const paymentMethod = document.getElementById('paymentMethod')?.value;
        
        return {
            paymentMethod: paymentMethod,
            orderNumber: paymentMethod !== 'waiver' ? document.getElementById('orderNumber')?.value : null,
            waiverRequested: paymentMethod === 'waiver',
            waiverConfirmed: paymentMethod === 'waiver' ? 
                document.getElementById('waiverCheck1')?.checked && 
                document.getElementById('waiverCheck2')?.checked : null
        };
    }
    
    function getSectionPData() {
        return {
            checklistComplete: {
                formComplete: document.getElementById('checkCompleteForm')?.checked,
                materialsGathered: document.getElementById('checkMaterials')?.checked,
                referencesRequested: document.getElementById('checkReferences')?.checked,
                paymentArranged: document.getElementById('checkPayment')?.checked
            }
        };
    }
    
    function getSectionQData() {
        return {
            declaration: {
                date: document.getElementById('date')?.value,
                printedName: document.getElementById('print-name')?.value
            }
        };
    }
    
    async function sendFormData(payload) {
        try {
            const fd = new FormData();
            // send payload
            fd.append('payload', JSON.stringify(payload));

            // section L
            const waiverFile = document.getElementById('waiverFile')?.files[0] || null;
            if (waiverFile) {
                console.log('waiver ok')
                fd.append('waiver', waiverFile);
            }

            // section N
            const transcriptFile = document.getElementById('transcriptUpload')?.files[0] || null;
            if (transcriptFile) {
                fd.append('transcript', transcriptFile);
            }
            const cvFile         = document.getElementById('CVUpload')?.files[0] || null;
            if (cvFile) {
                fd.append('cv', cvFile);
            }
            const statementFile  = document.getElementById('statementUpload')?.files[0] || null;
            if (statementFile) {
                fd.append('statement', statementFile);
            }
            const written1Checkbox      = document.querySelector('[name="documents"][value="written1"]');
            const written1File          = written1Checkbox?.checked ? document.querySelector('[name="written1Upload"]')?.files[0] || null : null;
            if (written1File) {
                fd.append('written1', written1File);
            }
            const written2Checkbox      = document.querySelector('[name="documents"][value="written2"]');
            const written2File          = written2Checkbox?.checked ? document.querySelector('[name="written2Upload"]')?.files[0] || null : null;
            if (written2File) {
                fd.append('written2', written2File);
            }
            const singleWrittenCheckbox = document.querySelector('[name="documents"][value="singleWritten"]');
            const singleWrittenFile     = singleWrittenCheckbox?.checked ? document.querySelector('[name="singleWrittenUpload"]')?.files[0] || null : null;
            if (singleWrittenFile) {
                fd.append('singleWritten', singleWrittenFile);
            }
            const portfolioCheckbox     = document.querySelector('[name="documents"][value="portfolio"]');
            const portfolioFile         = portfolioCheckbox?.checked ? document.querySelector('[name="portfolioUpload"]')?.files[0] || null : null;
            if (portfolioFile) {
                fd.append('portfolio', portfolioFile);
            }
            const englishTestCheckbox   = document.querySelector('[name="documents"][value="englishTest"]');
            const englishTestFile       = englishTestCheckbox?.checked ? document.querySelector('[name="englishTestUpload"]')?.files[0] || null : null;
            if (englishTestFile) {
                fd.append('englishTest', englishTestFile);
            }
            const greCheckbox           = document.querySelector('[name="documents"][value="gre"]');
            const greFile               = greCheckbox?.checked ? document.querySelector('[name="greUpload"]')?.files[0] || null : null;
            if  (greFile) {            
                fd.append('gre', greFile);
            }
            const waiverLetterCheckbox  = document.querySelector('[name="documents"][value="waiverLetter"]');
            const waiverLetterFile      = waiverLetterCheckbox?.checked ? document.querySelector('[name="waiverLetterUpload"]')?.files[0] || null : null;
            if (waiverLetterFile) {
                fd.append('waiverLetter', waiverLetterFile);
            }
            const scholarshipCheckbox   = document.querySelector('[name="documents"][value="scholarshipSupport"]');
            const scholarshipFile       = scholarshipCheckbox?.checked ? document.querySelector('[name="scholarshipSupportUpload"]')?.files[0] || null : null;
            if (scholarshipFile) {
                fd.append('scholarshipSupport', scholarshipFile);
            }

            // section Q
            const signatureFile = document.getElementById('signature-upload')?.files[0] || null;
            if (signatureFile) {
                console.log('signature ok')
                fd.append('signature', signatureFile);
            }

            const token = localStorage.getItem("token");
            const data = await fetch("/api/applicant/apply", {
                method: "POST",
                body: fd,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`,
                }
            });
            console.log('Success:', data);
        } catch (error) {
            console.error('Error:', error);
            alert('Error submitting application. Please try again.');
        }
    }
});