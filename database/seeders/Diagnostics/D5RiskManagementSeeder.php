<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D5RiskManagementSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing items for this domain to prevent duplicates
        DiagnosticItem::whereHas('topic.domain', function($query) {
            $query->where('name', 'Risk Management');
        })->forceDelete();
        
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Risk Management');
        })->pluck('id', 'name');
        
        
        $items = [
            // IT Risk Management Lifecycle - Item 1
            [
                'topic_id' => $topics['IT Risk Management Lifecycle'] ?? 100,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the correct sequence of the IT Risk Management Lifecycle?',
                'options' => [
                    'Assess → Identify → Monitor → Treat',
                    'Identify → Assess → Treat → Monitor',
                    'Monitor → Assess → Identify → Treat',
                    'Treat → Identify → Assess → Monitor'
                ],
                'correct_options' => ['Identify → Assess → Treat → Monitor'],
                'justifications' => [
                    'Cannot assess risks before identifying them',
                    'Correct - First identify risks, assess their impact, treat them, then monitor effectiveness',
                    'Monitoring comes after treatment, not before identification',
                    'Treatment cannot occur before understanding the risks'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Risk Identification - Item 2
            [
                'topic_id' => $topics['Risk Identification'] ?? 101,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Select the appropriate inputs for risk identification:',
                'options' => [
                    'Threat intelligence reports',
                    'Last year\'s profit margins',
                    'Vulnerability scan results',
                    'Employee vacation schedules',
                    'Asset inventory',
                    'Cafeteria menu'
                ],
                'correct_options' => ['Threat intelligence reports', 'Vulnerability scan results', 'Asset inventory'],
                'justifications' => [
                    'Threat intelligence identifies potential threats',
                    'Profit margins are financial, not risk inputs',
                    'Vulnerability scans reveal weaknesses',
                    'Vacation schedules are HR matters',
                    'Asset inventory shows what needs protection',
                    'Cafeteria menus are irrelevant to risk'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Risk Assessment - Item 3
            [
                'topic_id' => $topics['Risk Assessment'] ?? 102,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'In qualitative risk assessment, risk is typically calculated as:',
                'options' => [
                    'Threat × Vulnerability × Asset Value',
                    'Likelihood × Impact',
                    'Cost × Benefit',
                    'Exposure × Frequency'
                ],
                'correct_options' => ['Likelihood × Impact'],
                'justifications' => [
                    'This is a more complex formula not typically used in qualitative assessment',
                    'Correct - Qualitative risk assessment uses likelihood and impact ratings',
                    'Cost-benefit is for risk treatment decisions',
                    'This is more suited to quantitative assessment'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Quantitative vs Qualitative - Item 4
            [
                'topic_id' => $topics['Risk Assessment'] ?? 102,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each characteristic with the appropriate risk assessment type:',
                'options' => [
                    'items' => [
                        'Uses High/Medium/Low ratings',
                        'Calculates Annual Loss Expectancy',
                        'Requires less time and resources',
                        'Provides monetary values'
                    ],
                    'targets' => [
                        'Qualitative Assessment',
                        'Quantitative Assessment'
                    ]
                ],
                'correct_options' => [
                    'Uses High/Medium/Low ratings' => 'Qualitative Assessment',
                    'Calculates Annual Loss Expectancy' => 'Quantitative Assessment',
                    'Requires less time and resources' => 'Qualitative Assessment',
                    'Provides monetary values' => 'Quantitative Assessment'
                ],
                'justifications' => [
                    'Uses High/Medium/Low ratings' => 'Qualitative uses descriptive scales',
                    'Calculates Annual Loss Expectancy' => 'ALE is a quantitative calculation',
                    'Requires less time and resources' => 'Qualitative is faster and simpler',
                    'Provides monetary values' => 'Quantitative expresses risk in financial terms'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Risk Response - Item 5
            [
                'topic_id' => $topics['Risk Response & Treatment'] ?? 103,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization decides to purchase cyber insurance to address the risk of ransomware attacks. This is an example of:',
                'options' => [
                    'Risk avoidance',
                    'Risk acceptance',
                    'Risk transfer',
                    'Risk mitigation'
                ],
                'correct_options' => ['Risk transfer'],
                'justifications' => [
                    'Avoidance would mean not using systems that could be attacked',
                    'Acceptance would mean taking no action',
                    'Correct - Insurance transfers financial impact to the insurer',
                    'Mitigation would involve controls to reduce likelihood or impact'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Risk Treatment Options - Item 6
            [
                'topic_id' => $topics['Risk Response & Treatment'] ?? 103,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'A company faces a risk of data breach from an outdated system. Select all valid risk treatment options:',
                'options' => [
                    'Upgrade the system (Mitigate)',
                    'Ignore the risk (Denial)',
                    'Decommission the system (Avoid)',
                    'Document and monitor (Accept)',
                    'Outsource to secure provider (Transfer)',
                    'Hope it doesn\'t happen (Wishful thinking)'
                ],
                'correct_options' => [
                    'Upgrade the system (Mitigate)',
                    'Decommission the system (Avoid)',
                    'Document and monitor (Accept)',
                    'Outsource to secure provider (Transfer)'
                ],
                'justifications' => [
                    'Upgrading reduces the vulnerability',
                    'Denial is not a valid risk treatment',
                    'Removing the system eliminates the risk',
                    'Accepting with documentation is valid for low risks',
                    'Outsourcing transfers risk to the provider',
                    'Hope is not a risk management strategy'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Risk Monitoring - Item 7
            [
                'topic_id' => $topics['Risk Monitoring & Reporting'] ?? 104,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Key Risk Indicators (KRIs) are used to:',
                'options' => [
                    'Calculate the exact cost of risks',
                    'Provide early warning of increasing risk exposure',
                    'Eliminate all organizational risks',
                    'Replace the need for risk assessments'
                ],
                'correct_options' => ['Provide early warning of increasing risk exposure'],
                'justifications' => [
                    'KRIs are indicators, not cost calculators',
                    'Correct - KRIs act as early warning signals for risk changes',
                    'Complete risk elimination is impossible',
                    'KRIs supplement but don\'t replace assessments'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Risk Appetite - Item 8
            [
                'topic_id' => $topics['Risk Appetite, Tolerance & Capacity'] ?? 105,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Risk appetite is the maximum amount of risk an organization can bear, while risk tolerance is the amount they are willing to accept.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'This is reversed. Risk appetite is the amount of risk an organization is willing to accept in pursuit of objectives. Risk capacity is the maximum amount they can bear without threatening their existence.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Risk Owner - Item 9
            [
                'topic_id' => $topics['Risk/Control Owner'] ?? 106,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Who should typically be assigned as a risk owner?',
                'options' => [
                    'The person who discovered the risk',
                    'The most junior team member',
                    'Someone with authority to manage the risk',
                    'Always the Chief Risk Officer'
                ],
                'correct_options' => ['Someone with authority to manage the risk'],
                'justifications' => [
                    'Discovery doesn\'t imply ownership capability',
                    'Junior members typically lack necessary authority',
                    'Correct - Risk owners need authority and resources to implement treatments',
                    'CRO oversees but doesn\'t own every individual risk'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Risk Register - Item 10
            [
                'topic_id' => $topics['Risk Register'] ?? 107,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Select the essential components of a risk register:',
                'options' => [
                    'Risk description',
                    'Employee salaries',
                    'Risk owner',
                    'Lunch preferences',
                    'Current controls',
                    'Office layout'
                ],
                'correct_options' => ['Risk description', 'Risk owner', 'Current controls'],
                'justifications' => [
                    'Clear description is essential for understanding',
                    'Salaries are HR data, not risk data',
                    'Ownership is crucial for accountability',
                    'Lunch preferences are irrelevant',
                    'Existing controls show current state',
                    'Office layout is facilities management'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Inherent vs Residual Risk - Item 11
            [
                'topic_id' => $topics['Inherent & Residual Risk'] ?? 108,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A server has an inherent risk rating of "High" for unauthorized access. After implementing strong authentication and access controls, the risk is reduced to "Medium". The "Medium" rating represents:',
                'options' => [
                    'Inherent risk',
                    'Residual risk',
                    'Acceptable risk',
                    'Transferred risk'
                ],
                'correct_options' => ['Residual risk'],
                'justifications' => [
                    'Inherent risk is before controls',
                    'Correct - Residual risk is what remains after controls are applied',
                    'Acceptable risk is a threshold, not a type',
                    'Risk wasn\'t transferred to another party'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Third-Party Risk - Item 12
            [
                'topic_id' => $topics['Third-Party & Supply-Chain Risk'] ?? 109,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A critical software vendor experiences a breach that exposes your customer data they were processing. This scenario represents:',
                'options' => [
                    'Internal risk',
                    'Third-party risk',
                    'Compliance risk only',
                    'Reputational risk only'
                ],
                'correct_options' => ['Third-party risk'],
                'justifications' => [
                    'The risk originated from an external vendor',
                    'Correct - This is a classic third-party risk materialization',
                    'It includes but isn\'t limited to compliance risk',
                    'It includes but isn\'t limited to reputational risk'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Risk Management Frameworks - Item 13
            [
                'topic_id' => $topics['Risk Management Frameworks'] ?? 110,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which risk management framework is specifically designed for US federal information systems?',
                'options' => [
                    'ISO 31000',
                    'COSO ERM',
                    'NIST RMF',
                    'FAIR'
                ],
                'correct_options' => ['NIST RMF'],
                'justifications' => [
                    'ISO 31000 is a general international standard',
                    'COSO focuses on enterprise risk management',
                    'Correct - NIST Risk Management Framework is designed for federal systems',
                    'FAIR focuses on cyber risk quantification'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Risk Calculation - Item 14
            [
                'topic_id' => $topics['Risk Assessment'] ?? 102,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'If a threat has a 20% chance of occurring annually and would cause $500,000 in damages, what is the Annual Loss Expectancy (ALE)?',
                'options' => [
                    '$20,000',
                    '$100,000',
                    '$500,000',
                    '$2,500,000'
                ],
                'correct_options' => ['$100,000'],
                'justifications' => [
                    'Incorrect calculation',
                    'Correct - ALE = Single Loss Expectancy × Annual Rate of Occurrence = $500,000 × 0.20',
                    'This is the SLE, not considering probability',
                    'This multiplies instead of using the percentage'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Risk Heat Map - Item 15
            [
                'topic_id' => $topics['Risk Assessment'] ?? 102,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'On a risk heat map, a risk plotted in the upper right corner indicates:',
                'options' => [
                    'Low likelihood, low impact',
                    'High likelihood, low impact',
                    'Low likelihood, high impact',
                    'High likelihood, high impact'
                ],
                'correct_options' => ['High likelihood, high impact'],
                'justifications' => [
                    'This would be lower left corner',
                    'This would be upper left corner',
                    'This would be lower right corner',
                    'Correct - Upper right represents high probability and high impact risks'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Risk Aggregation - Item 16
            [
                'topic_id' => $topics['Risk Monitoring & Reporting'] ?? 104,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When multiple low-rated risks combine to create a significant threat, this is called:',
                'options' => [
                    'Risk multiplication',
                    'Risk aggregation',
                    'Risk deflation',
                    'Risk isolation'
                ],
                'correct_options' => ['Risk aggregation'],
                'justifications' => [
                    'Not a standard risk management term',
                    'Correct - Risk aggregation occurs when multiple small risks combine into larger exposure',
                    'Deflation implies reduction, not combination',
                    'Isolation separates risks, doesn\'t combine them'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Control Effectiveness - Item 17
            [
                'topic_id' => $topics['Risk Response & Treatment'] ?? 103,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A control that reduces risk likelihood from "Very Likely" to "Possible" has impacted the risk\'s:',
                'options' => [
                    'Impact only',
                    'Likelihood only',
                    'Both likelihood and impact',
                    'Neither likelihood nor impact'
                ],
                'correct_options' => ['Likelihood only'],
                'justifications' => [
                    'The scenario describes likelihood change',
                    'Correct - The control reduced probability of occurrence',
                    'Only likelihood was mentioned as changing',
                    'Clearly the likelihood changed'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Risk Tolerance Levels - Item 18
            [
                'topic_id' => $topics['Risk Appetite, Tolerance & Capacity'] ?? 105,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Match risk types with typical organizational tolerance levels:',
                'options' => [
                    'Life safety risks',
                    'Innovation risks',
                    'Compliance violations',
                    'Market expansion risks',
                    'Data breach risks',
                    'New product development'
                ],
                'correct_options' => ['Life safety risks', 'Compliance violations', 'Data breach risks'],
                'justifications' => [
                    'Organizations have zero/low tolerance for safety risks',
                    'Innovation requires accepting some risk',
                    'Regulatory compliance typically has very low tolerance',
                    'Business growth requires risk-taking',
                    'Data breaches have severe consequences, low tolerance',
                    'Product development inherently involves risk'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Emerging Risks - Item 19
            [
                'topic_id' => $topics['Risk Identification'] ?? 101,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which technique is most effective for identifying emerging risks that haven\'t occurred yet?',
                'options' => [
                    'Historical data analysis',
                    'Incident report reviews',
                    'Scenario planning and horizon scanning',
                    'Last year\'s risk register'
                ],
                'correct_options' => ['Scenario planning and horizon scanning'],
                'justifications' => [
                    'Historical data won\'t show emerging risks',
                    'Incidents are past events, not future risks',
                    'Correct - These forward-looking techniques identify potential future risks',
                    'Past registers miss new and emerging risks'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Risk Communication - Item 20
            [
                'topic_id' => $topics['Risk Monitoring & Reporting'] ?? 104,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When reporting risks to the board of directors, which approach is most appropriate?',
                'options' => [
                    'Detailed technical vulnerability reports',
                    'Executive dashboard with key risks and trends',
                    'Complete risk register with all entries',
                    'Only risks that have materialized'
                ],
                'correct_options' => ['Executive dashboard with key risks and trends'],
                'justifications' => [
                    'Too technical for board-level discussion',
                    'Correct - Boards need high-level view with strategic implications',
                    'Too detailed and operational for board',
                    'Boards need to know potential risks too'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Supply Chain Risk - Item 21
            [
                'topic_id' => $topics['Third-Party & Supply-Chain Risk'] ?? 109,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'The SolarWinds attack, where malicious code was inserted into software updates affecting thousands of organizations, is an example of:',
                'options' => [
                    'Direct attack risk',
                    'Supply chain risk',
                    'Insider threat',
                    'Natural disaster risk'
                ],
                'correct_options' => ['Supply chain risk'],
                'justifications' => [
                    'Attack came through trusted supplier',
                    'Correct - Compromise of software supply chain affected downstream customers',
                    'Not from internal employees',
                    'This was a deliberate cyber attack'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Risk Velocity - Item 22
            [
                'topic_id' => $topics['Risk Assessment'] ?? 102,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Risk velocity refers to:',
                'options' => [
                    'How fast a risk moves through the organization',
                    'The speed at which a risk can impact the organization',
                    'How quickly risks are identified',
                    'The rate of risk acceptance'
                ],
                'correct_options' => ['The speed at which a risk can impact the organization'],
                'justifications' => [
                    'Risks don\'t physically move',
                    'Correct - Velocity measures time from risk occurrence to impact',
                    'This is about identification speed, not risk velocity',
                    'This relates to decision-making, not velocity'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Risk Treatment Cost-Benefit - Item 23
            [
                'topic_id' => $topics['Risk Response & Treatment'] ?? 103,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A risk has an ALE of $50,000. A control costing $60,000 annually would eliminate the risk. What should the organization do?',
                'options' => [
                    'Implement the control immediately',
                    'Look for more cost-effective alternatives',
                    'Accept the risk without controls',
                    'Transfer the risk regardless of cost'
                ],
                'correct_options' => ['Look for more cost-effective alternatives'],
                'justifications' => [
                    'Control costs more than the risk',
                    'Correct - Control cost exceeds benefit; seek better options',
                    'Some control may still be warranted',
                    'Transfer costs should also be considered'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Risk Categories - Item 24
            [
                'topic_id' => $topics['Risk Identification'] ?? 101,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each risk example with its primary category:',
                'options' => [
                    'items' => [
                        'Ransomware attack on systems',
                        'New privacy regulation penalties',
                        'Key employee resignation',
                        'Competitor launching superior product'
                    ],
                    'targets' => [
                        'Operational Risk',
                        'Compliance Risk',
                        'Strategic Risk',
                        'Financial Risk'
                    ]
                ],
                'correct_options' => [
                    'Ransomware attack on systems' => 'Operational Risk',
                    'New privacy regulation penalties' => 'Compliance Risk',
                    'Key employee resignation' => 'Operational Risk',
                    'Competitor launching superior product' => 'Strategic Risk'
                ],
                'justifications' => [
                    'Ransomware attack on systems' => 'Disrupts operations and service delivery',
                    'New privacy regulation penalties' => 'Regulatory compliance failure risk',
                    'Key employee resignation' => 'Affects operational capability',
                    'Competitor launching superior product' => 'Threatens market position and strategy'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Monte Carlo Simulation - Item 25
            [
                'topic_id' => $topics['Risk Assessment'] ?? 102,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Monte Carlo simulation in risk assessment is used to:',
                'options' => [
                    'Eliminate all uncertainty',
                    'Model probability distributions of outcomes',
                    'Guarantee specific results',
                    'Replace expert judgment'
                ],
                'correct_options' => ['Model probability distributions of outcomes'],
                'justifications' => [
                    'Cannot eliminate uncertainty, only model it',
                    'Correct - Monte Carlo runs many scenarios to show outcome probabilities',
                    'Shows probabilities, not guarantees',
                    'Supplements but doesn\'t replace judgment'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Risk Interdependencies - Item 26
            [
                'topic_id' => $topics['Risk Monitoring & Reporting'] ?? 104,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Two risks are considered to have positive correlation when:',
                'options' => [
                    'They never occur together',
                    'One occurring increases likelihood of the other',
                    'They cancel each other out',
                    'They have no relationship'
                ],
                'correct_options' => ['One occurring increases likelihood of the other'],
                'justifications' => [
                    'This describes negative correlation',
                    'Correct - Positive correlation means risks tend to occur together',
                    'This would be risk mitigation',
                    'This describes independence, not correlation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Black Swan Events - Item 27
            [
                'topic_id' => $topics['Risk Identification'] ?? 101,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Black swan events are high-impact risks that are impossible to predict but obvious in hindsight.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'Black swan events, as defined by Nassim Taleb, are characterized by: extreme rarity, severe impact, and retrospective (though not prospective) predictability. Examples include 9/11 or the 2008 financial crisis.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Risk vs Issue - Item 28
            [
                'topic_id' => $topics['Risk Monitoring & Reporting'] ?? 104,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the key difference between a risk and an issue?',
                'options' => [
                    'Risks are more serious than issues',
                    'Issues are potential events, risks have occurred',
                    'Risks are potential events, issues have occurred',
                    'There is no difference'
                ],
                'correct_options' => ['Risks are potential events, issues have occurred'],
                'justifications' => [
                    'Severity doesn\'t distinguish them',
                    'This is backwards',
                    'Correct - Risks may happen, issues are current problems',
                    'Clear distinction exists in risk management'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Bow-Tie Analysis - Item 29
            [
                'topic_id' => $topics['Risk Assessment'] ?? 102,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'In bow-tie risk analysis, preventive controls are placed on which side of the risk event?',
                'options' => [
                    'Left side (before the event)',
                    'Right side (after the event)',
                    'Both sides equally',
                    'Center (at the event)'
                ],
                'correct_options' => ['Left side (before the event)'],
                'justifications' => [
                    'Correct - Preventive controls on left prevent the event from occurring',
                    'Right side has recovery/mitigation controls',
                    'Controls are specifically positioned by type',
                    'The center represents the risk event itself'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Risk Culture - Item 30
            [
                'topic_id' => $topics['IT Risk Management Lifecycle'] ?? 100,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which behavior indicates a mature risk culture in an organization?',
                'options' => [
                    'Hiding problems to avoid blame',
                    'Taking excessive risks for rewards',
                    'Open discussion of risks without fear',
                    'Avoiding all risks completely'
                ],
                'correct_options' => ['Open discussion of risks without fear'],
                'justifications' => [
                    'Fear-based culture inhibits risk management',
                    'Excessive risk-taking shows poor culture',
                    'Correct - Psychological safety enables effective risk identification',
                    'Zero risk tolerance is unrealistic and harmful'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Cascading Risks - Item 31
            [
                'topic_id' => $topics['Risk Monitoring & Reporting'] ?? 104,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A data center power failure leads to system outages, which cause transaction failures, resulting in customer dissatisfaction and revenue loss. This is an example of:',
                'options' => [
                    'Risk aggregation',
                    'Cascading risks',
                    'Risk correlation',
                    'Risk mitigation'
                ],
                'correct_options' => ['Cascading risks'],
                'justifications' => [
                    'Aggregation combines separate risks',
                    'Correct - One risk triggers a chain of subsequent risks',
                    'Correlation is about risks occurring together',
                    'This describes risk materialization, not mitigation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // FAIR Model - Item 32
            [
                'topic_id' => $topics['Risk Management Frameworks'] ?? 110,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'The FAIR (Factor Analysis of Information Risk) model primarily focuses on:',
                'options' => [
                    'Qualitative risk descriptions',
                    'Quantifying information risk in financial terms',
                    'Compliance risk assessment',
                    'Physical security risks'
                ],
                'correct_options' => ['Quantifying information risk in financial terms'],
                'justifications' => [
                    'FAIR emphasizes quantitative analysis',
                    'Correct - FAIR provides a model for quantifying cyber risk financially',
                    'FAIR is broader than just compliance',
                    'FAIR focuses on information/cyber risk'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Risk Reporting Frequency - Item 33
            [
                'topic_id' => $topics['Risk Monitoring & Reporting'] ?? 104,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How often should critical risks be reviewed and reported to senior management?',
                'options' => [
                    'Annually',
                    'When incidents occur',
                    'Monthly or quarterly',
                    'Every 3-5 years'
                ],
                'correct_options' => ['Monthly or quarterly'],
                'justifications' => [
                    'Too infrequent for critical risks',
                    'Reactive approach is insufficient',
                    'Correct - Critical risks need regular monitoring and reporting',
                    'Far too infrequent for any risks'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Vendor Risk Assessment - Item 34
            [
                'topic_id' => $topics['Third-Party & Supply-Chain Risk'] ?? 109,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Select critical factors to assess in vendor risk management:',
                'options' => [
                    'Financial stability',
                    'Office décor',
                    'Security certifications',
                    'Employee dress code',
                    'Business continuity plans',
                    'Cafeteria quality'
                ],
                'correct_options' => ['Financial stability', 'Security certifications', 'Business continuity plans'],
                'justifications' => [
                    'Financial health affects service continuity',
                    'Décor is irrelevant to risk',
                    'Certifications demonstrate security maturity',
                    'Dress code doesn\'t impact risk',
                    'BC plans ensure service resilience',
                    'Food quality is not a risk factor'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Risk Matrix Limitations - Item 35
            [
                'topic_id' => $topics['Risk Assessment'] ?? 102,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is a key limitation of using 5x5 risk matrices?',
                'options' => [
                    'They are too complex to understand',
                    'They can oversimplify complex risks',
                    'They provide too much detail',
                    'They only work for IT risks'
                ],
                'correct_options' => ['They can oversimplify complex risks'],
                'justifications' => [
                    '5x5 matrices are relatively simple',
                    'Correct - Matrices may lose nuance and create false precision',
                    'Matrices provide high-level views',
                    'Risk matrices apply to all risk types'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Operational Risk Indicators - Item 36
            [
                'topic_id' => $topics['Risk Monitoring & Reporting'] ?? 104,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which metric would be a good Key Risk Indicator (KRI) for payment card data breach risk?',
                'options' => [
                    'Number of employees',
                    'Failed PCI compliance scan findings',
                    'Total revenue',
                    'Office locations'
                ],
                'correct_options' => ['Failed PCI compliance scan findings'],
                'justifications' => [
                    'Employee count doesn\'t indicate PCI risk',
                    'Correct - PCI scan failures directly indicate payment card security weaknesses',
                    'Revenue doesn\'t measure security posture',
                    'Geography doesn\'t indicate PCI compliance'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Risk Treatment Validation - Item 37
            [
                'topic_id' => $topics['Risk Response & Treatment'] ?? 103,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'After implementing risk treatments, what is the next critical step?',
                'options' => [
                    'Close the risk in the register',
                    'Celebrate successful implementation',
                    'Test control effectiveness',
                    'Move to the next risk'
                ],
                'correct_options' => ['Test control effectiveness'],
                'justifications' => [
                    'Risk remains until controls prove effective',
                    'Premature without validation',
                    'Correct - Must verify controls actually reduce risk as intended',
                    'Skips critical validation step'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Cyber Insurance Considerations - Item 38
            [
                'topic_id' => $topics['Risk Response & Treatment'] ?? 103,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization is considering cyber insurance. Which risk aspect does insurance NOT address?',
                'options' => [
                    'Financial losses from breaches',
                    'Legal defense costs',
                    'Likelihood of attacks occurring',
                    'Business interruption costs'
                ],
                'correct_options' => ['Likelihood of attacks occurring'],
                'justifications' => [
                    'Insurance covers financial impacts',
                    'Legal costs are typically covered',
                    'Correct - Insurance transfers impact but doesn\'t prevent attacks',
                    'BI coverage is common in cyber policies'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Concentration Risk - Item 39
            [
                'topic_id' => $topics['Third-Party & Supply-Chain Risk'] ?? 109,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization relies on a single cloud provider for all critical systems. This represents:',
                'options' => [
                    'Diversification risk',
                    'Concentration risk',
                    'Systemic risk',
                    'Residual risk'
                ],
                'correct_options' => ['Concentration risk'],
                'justifications' => [
                    'Opposite - lack of diversification',
                    'Correct - Over-reliance on single provider creates concentration risk',
                    'Systemic affects entire market/system',
                    'Residual is post-control risk level'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Risk Appetite Statement - Item 40
            [
                'topic_id' => $topics['Risk Appetite, Tolerance & Capacity'] ?? 105,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A well-written risk appetite statement should include:',
                'options' => [
                    'Technical vulnerability details',
                    'Specific risk tolerance thresholds',
                    'Individual employee names',
                    'Competitor risk levels'
                ],
                'correct_options' => ['Specific risk tolerance thresholds'],
                'justifications' => [
                    'Too operational for appetite statements',
                    'Correct - Clear thresholds guide risk-taking decisions',
                    'Too specific and changeable',
                    'Focus on own appetite, not competitors'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Scenario Analysis - Item 41
            [
                'topic_id' => $topics['Risk Assessment'] ?? 102,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When conducting scenario analysis for business continuity, which approach is most valuable?',
                'options' => [
                    'Only considering best-case scenarios',
                    'Focusing on most likely scenarios and extremes',
                    'Planning for every possible scenario',
                    'Using last year\'s scenarios only'
                ],
                'correct_options' => ['Focusing on most likely scenarios and extremes'],
                'justifications' => [
                    'Ignores potential negative impacts',
                    'Correct - Balance realistic scenarios with high-impact edge cases',
                    'Impossible and resource-intensive',
                    'Misses new and emerging threats'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Risk Financing - Item 42
            [
                'topic_id' => $topics['Risk Response & Treatment'] ?? 103,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each risk financing method with its description:',
                'options' => [
                    'items' => [
                        'Setting aside funds for potential losses',
                        'Purchasing insurance policies',
                        'Creating a subsidiary to self-insure',
                        'Contractual risk transfer to vendors'
                    ],
                    'targets' => [
                        'Risk retention/reserves',
                        'Risk transfer',
                        'Captive insurance',
                        'Contractual transfer'
                    ]
                ],
                'correct_options' => [
                    'Setting aside funds for potential losses' => 'Risk retention/reserves',
                    'Purchasing insurance policies' => 'Risk transfer',
                    'Creating a subsidiary to self-insure' => 'Captive insurance',
                    'Contractual risk transfer to vendors' => 'Contractual transfer'
                ],
                'justifications' => [
                    'Setting aside funds for potential losses' => 'Self-funding through reserves',
                    'Purchasing insurance policies' => 'Classic risk transfer mechanism',
                    'Creating a subsidiary to self-insure' => 'Captive insurance company approach',
                    'Contractual risk transfer to vendors' => 'Using contracts to shift liability'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Emerging Risk Management - Item 43
            [
                'topic_id' => $topics['Risk Identification'] ?? 101,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which emerging technology risk should organizations prioritize in 2024 and beyond?',
                'options' => [
                    'Y2K compliance',
                    'AI and machine learning risks',
                    'Dial-up internet security',
                    'Floppy disk viruses'
                ],
                'correct_options' => ['AI and machine learning risks'],
                'justifications' => [
                    'Y2K was a past issue from 2000',
                    'Correct - AI/ML presents new and evolving risks requiring attention',
                    'Dial-up is largely obsolete',
                    'Floppy disks are no longer in use'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Risk Quantification Challenge - Item 44
            [
                'topic_id' => $topics['Risk Assessment'] ?? 102,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When quantifying reputational risk from a data breach, what is the biggest challenge?',
                'options' => [
                    'Calculating direct costs',
                    'Measuring intangible impacts',
                    'Determining legal fees',
                    'Counting affected records'
                ],
                'correct_options' => ['Measuring intangible impacts'],
                'justifications' => [
                    'Direct costs are relatively straightforward',
                    'Correct - Reputation damage, customer trust loss are hard to quantify',
                    'Legal fees can be estimated',
                    'Record counts are factual data'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Control Risk Assessment - Item 45
            [
                'topic_id' => $topics['Risk/Control Owner'] ?? 106,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A control owner discovers their control is no longer effective due to technology changes. What is their primary responsibility?',
                'options' => [
                    'Hide the issue to avoid blame',
                    'Wait for the next audit to reveal it',
                    'Immediately escalate to risk owner',
                    'Fix it without telling anyone'
                ],
                'correct_options' => ['Immediately escalate to risk owner'],
                'justifications' => [
                    'Transparency is essential in risk management',
                    'Proactive response required, not reactive',
                    'Correct - Risk owner must be informed to reassess risk and treatment',
                    'Risk owner needs visibility for proper management'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Risk Management Definition - Item 46 (NEW - Level 1)
            [
                'topic_id' => $topics['IT Risk Management Lifecycle'] ?? 100,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Risk management is defined as:',
                'options' => [
                    'The elimination of all organizational risks',
                    'Coordinated activities to direct and control risk',
                    'The purchase of insurance policies',
                    'Avoiding all uncertain situations'
                ],
                'correct_options' => ['Coordinated activities to direct and control risk'],
                'justifications' => [
                    'Complete risk elimination is impossible',
                    'Correct - ISO 31000 definition of risk management',
                    'Insurance is just one risk treatment option',
                    'Some uncertainty is necessary for business'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Risk Appetite vs Risk Tolerance - Item 47 (NEW - Level 1)
            [
                'topic_id' => $topics['Risk Appetite, Tolerance & Capacity'] ?? 105,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the key difference between risk appetite and risk tolerance?',
                'options' => [
                    'Risk appetite is qualitative, risk tolerance is quantitative',
                    'Risk appetite is for operational risks, risk tolerance is for strategic risks',
                    'Risk appetite is the amount of risk willing to accept, risk tolerance is the variance allowed',
                    'There is no difference - they are the same concept'
                ],
                'correct_options' => ['Risk appetite is the amount of risk willing to accept, risk tolerance is the variance allowed'],
                'justifications' => [
                    'Both can be expressed qualitatively or quantitatively',
                    'Both apply to all types of risks, not specific categories',
                    'Correct - Risk appetite is the broad amount of risk acceptable, while risk tolerance is the acceptable deviation from that level',
                    'They are distinct but related concepts in risk management'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Risk Treatment Implementation - Item 48 (NEW - Level 3)
            [
                'topic_id' => $topics['Risk Response & Treatment'] ?? 103,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Your organization faces ransomware risk with High likelihood and Critical impact. You have a $100,000 annual budget for this risk. Which combination would be most appropriate?',
                'options' => [
                    'Accept the risk and save the budget',
                    'Implement backup systems ($40K) + endpoint protection ($35K) + security training ($15K)',
                    'Purchase only cyber insurance ($80K)',
                    'Avoid by disconnecting all systems from internet'
                ],
                'correct_options' => ['Implement backup systems ($40K) + endpoint protection ($35K) + security training ($15K)'],
                'justifications' => [
                    'High/Critical risks require action, not acceptance',
                    'Correct - Multi-layered approach addresses prevention, protection, and recovery',
                    'Insurance alone doesn\'t reduce likelihood',
                    'Complete avoidance would eliminate business functionality'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Control Selection - Item 49 (NEW - Level 3)
            [
                'topic_id' => $topics['Risk Response & Treatment'] ?? 103,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization wants to implement access controls for their database containing customer PII. Which control combination provides defense in depth?',
                'options' => [
                    'Strong passwords only',
                    'Multi-factor authentication + role-based access + encryption + audit logging',
                    'Physical security only',
                    'Employee training only'
                ],
                'correct_options' => ['Multi-factor authentication + role-based access + encryption + audit logging'],
                'justifications' => [
                    'Single control is insufficient for critical data',
                    'Correct - Multiple complementary controls provide layered protection',
                    'Physical security doesn\'t address logical access',
                    'Training alone cannot prevent all threats'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Vendor Assessment Application - Item 50 (NEW - Level 3)
            [
                'topic_id' => $topics['Third-Party & Supply-Chain Risk'] ?? 109,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A cloud provider storing your customer data reports a security incident affecting their infrastructure. What is your immediate priority?',
                'options' => [
                    'Terminate the contract immediately',
                    'Assess impact on your data and customers',
                    'Wait for more information',
                    'Inform all customers immediately'
                ],
                'correct_options' => ['Assess impact on your data and customers'],
                'justifications' => [
                    'Premature without understanding the impact',
                    'Correct - First determine scope and impact before taking action',
                    'Time-sensitive situation requires immediate assessment',
                    'Need facts before communicating to avoid misinformation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Additional questions to reach perfect 7-10-16-10-7 distribution
            // Need: +1 Level 1 and +1 Level 4
            
            // Item 51 - Level 1 (Remember)
            [
                'topic_id' => $topics['Risk Assessment'] ?? 102,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the formula for calculating risk?',
                'options' => [
                    'Risk = Threat + Vulnerability',
                    'Risk = Impact × Likelihood',
                    'Risk = Asset Value - Controls',
                    'Risk = Threat × Asset Value'
                ],
                'correct_options' => ['Risk = Impact × Likelihood'],
                'justifications' => [
                    'This is addition, not the standard risk formula',
                    'Correct - Risk is calculated as Impact multiplied by Likelihood',
                    'This is not the standard risk calculation',
                    'This doesn\'t include likelihood component'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 52 - Level 4 (Analyze)
            [
                'topic_id' => $topics['Risk Response & Treatment'] ?? 103,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Your organization faces a high-impact, low-likelihood risk that would cost $10M to prevent and $50M if it occurs. The annual probability is 5%. Analyzing the cost-benefit, what is the recommended approach?',
                'options' => [
                    'Accept the risk due to low probability',
                    'Implement the $10M prevention as expected loss ($2.5M annually) exceeds prevention cost',
                    'Transfer the risk through insurance',
                    'Reduce the risk through partial controls'
                ],
                'correct_options' => ['Transfer the risk through insurance'],
                'justifications' => [
                    'High impact makes acceptance risky despite low probability',
                    'Annual expected loss ($2.5M) is less than prevention cost ($10M)',
                    'Correct - Insurance can transfer this high-impact, low-probability risk cost-effectively',
                    'Partial controls may not adequately address the high impact'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('Domain 5 (Risk Management) diagnostic items seeded successfully!');
    }
}